<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

final class NotifyApplicationReceivedJob implements ShouldQueue
{
    use Queueable;

    public final function __construct(
        private readonly string $subject,
        private readonly string $body,
    )
    {
    }

    public final function handle(): void
    {
        $recipient = config('association.notifications.applications_email');

        if (!$recipient) {
            return;
        }

        Mail::raw($this->body, function ($message) use ($recipient) {
            $message->to($recipient)->subject($this->subject);
        });
    }
}
