<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UploadController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index()
  {
    try {
      $user = auth()->user();
      $uploads = Upload::where('user_id', $user->id)->get()->toArray();
      return response()->json(['uploads' => $uploads]);
    } catch (\Exception $exception) {
      return response()->json(['upload' => false, 'message' => $exception->getMessage()]);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {
    try {
      $request->validate([
        'file' => 'required|file|mimes:png,pdf,jpg,jpeg|max:2048',
        'description' => 'nullable|string'
      ]);
      $uploader = auth()->user();
      $file = $request->file('file');
      $documentPath = $this->storeFileAndCreateLink($uploader->id, 'uploads', $file);
      $newUpload = Upload::create([
        'name' => $file->getClientOriginalName(),
        'description' => $request->get('description'),
        'path' => $documentPath['public_path'],
        'user_id' => $uploader->id
      ]);
      return response()->json(['upload' => $newUpload, 'message' => 'File uploaded successfully!']);
    } catch (PostTooLargeException $postTooLargeException) {
      return response()->json(['upload' => false, 'message' => $postTooLargeException->getMessage()]);
    } catch (ValidationException $validationException) {
      return response()->json(['upload' => false, 'message' => implode(' ', \Illuminate\Support\Arr::flatten($validationException->errors()))]);
    } catch (\Exception $exception) {
      return response()->json(['upload' => false, 'message' => $exception->getMessage()]);
    }
  }

  public function storeFileAndCreateLink(int $uploaderId, string $storageFolder, $file): array
  {
    $originalFileName = $file->getClientOriginalName();
    $fileExtension = $file->getClientOriginalExtension();

    $fileName = str_replace('.' . $fileExtension, "", $originalFileName);
    $fileName = strtolower(preg_replace("/[^a-z0-9\_\-\.]/i", '', $fileName));

    $preparedFileName = $fileName . '-' . time() . '.' . $fileExtension;
    $storagePath = storage_path("app/public/$storageFolder/$uploaderId");

    if (!Storage::exists("public/$storageFolder/" . $uploaderId)) {
      Storage::makeDirectory("public/$storageFolder/" . $uploaderId);
    }
    $file->move($storagePath, $preparedFileName);

    return [
      'public_path' => "/storage/$storageFolder/$uploaderId/$preparedFileName",
      'storage_path' => "$storagePath/$preparedFileName"
    ];
  }
}
