<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Live\Entities\Live;

class LiveEventNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $liveEvent;

    public function __construct(Live $liveEvent)
    {
        $this->liveEvent = $liveEvent;
    }

    public function build()
    {
        return $this->view('newsletter::email.live_video_notification')
                    ->subject('À venir en direct !')
                    ->with([
                        'liveEvent' => $this->liveEvent,
                    ]);
    }
}
