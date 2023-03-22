@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>File Uploader</h1>
        <div class="mt-4 p-5 bg-primary text-white rounded">
            <h2>App for uploading files with laravel</h2>
            <p>This app was developed by Djordje Arsenovic a.k.a <a href="https://djolecodes.com" target="_blank"
                    rel="noopener" class="text-white">djoleCodes</a>. It's part of the tutorial <a
                    href="https://djolecodes.com/how-to-upload-files-with-react-laravel/" target="_blank" class="text-white"
                    rel="noopener">
                    How to upload files with React and laravel
                </a>,
                It's developed using laravel and react frameworks.</p>
            <h3>App features</h3>
            <ul class="list-group">
                <li class="list-group-item">
                    You can register and login
                </li>
                <li class="list-group-item">
                    You can upload files
                </li>
                <li class="list-group-item">
                    You can upload files of type: png,pdf,jpg,jpeg
                </li>
                <li class="list-group-item">
                    Maximum file size is 2mb = 2048kb
                </li>
                <li class="list-group-item">
                    You can set the file description
                </li>
            </ul>
        </div>
    </div>
@endsection
