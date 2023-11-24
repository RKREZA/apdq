<?php

namespace Modules\Setting\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = auth()->user()->name.' | '.auth()->user()->designation;
        return $this->from(auth()->user()->email, $name)
                    ->subject(config('app.name').' | '.$this->details['title'])
                    ->view('setting::mail.mail');
    }
}
