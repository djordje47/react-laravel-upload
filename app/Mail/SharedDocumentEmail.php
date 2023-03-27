<?php

namespace App\Mail;

use App\Models\Upload;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SharedDocumentEmail extends Mailable
{
  use Queueable, SerializesModels;

  private User $user;
  private Upload $document;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(User $user, Upload $document)
  {
    $this->user = $user;
    $this->document = $document;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $dbPath = explode('/', $this->document->path);
    $fileName = end($dbPath);
    return
      $this->view('mail.shared_document')
        ->attach(storage_path('app/public/uploads/' . $this->document->user_id . '/' . $fileName))
        ->with(['user' => $this->user, 'document' => $this->document]);
  }
}
