<?php

namespace App\Jobs;

use App\Mail\SharedDocumentEmail;
use App\Mail\WelcomeEmail;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * User that uploaded the file
   * @var \App\Models\User
   */
  private User $user;
  private array $sharedEmails;
  private Upload $document;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(User $user, Upload $document)
  {
    $this->user = $user;
    $this->sharedEmails = $document->emails;
    $this->document = $document;
  }

  /**
   * Execute the job.
   *
   */
  public function handle()
  {
    try {
      foreach ($this->sharedEmails as $sharedEmail) {
        Mail::to($sharedEmail)
          ->send(new SharedDocumentEmail($this->user, $this->document));
      }
    } catch (\Exception $exception) {
      Log::error('Mail not sent! ' . $exception->getMessage());
    }
  }
}
