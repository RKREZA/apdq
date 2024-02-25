<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Modules\Newsletter\Entities\Newsletter;
use Modules\Newsletter\Entities\NewsletterCategory;
use Modules\Live\Entities\Live;
use Carbon\Carbon;
use App\Mail\LiveEventNotification;

class SendLiveNotificationEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $liveEvent;

    public function __construct(Live $liveEvent)
    {
        $this->liveEvent = $liveEvent;
    }

    public function handle()
    {
        $liveCategory = NewsletterCategory::where('name', 'live')->first();

        if (!$liveCategory) {
            return;
        }

        $subscribers = Newsletter::where('category_id', $liveCategory->id)->get();

        foreach ($subscribers as $subscriber) {
            // Send email to $subscriber->email
            // You need to setup a Mailable or use a simple Mail::send() here
            Mail::to($subscriber->email)->send(new LiveEventNotification($this->liveEvent));
        }
    }
}
