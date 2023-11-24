<?php

namespace Modules\Notification\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

class ApprovalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;

    protected $signature = 'approvalnotification:cron';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        // dd($this->data);
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     *
     */
    public function via($notifiable)
    {
        return ['database','mail']; //to send notification in mail use 'mail'
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Approval Notification | '.$this->data['from'].' | '.$this->data['status'])
            ->action('বিস্তারিত', $this->data['url'])
            ->view('notification::email.template', [
                'title' => $this->data['title'],
                'description' => $this->data['description'],
                'status' => $this->data['status'],
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'email_id'              => $this->data['id'],
            'action'                => $this->data['action'],
            'message_title'         => $this->data['title'],
            'message_description'   => $this->data['description'],
        ];
    }



    public function viaQueues()
    {
        return [
            'mail' => 'mail-queue',
        ];
    }

    public function handle()
    {
        Log::info("Cron is working fine!");

        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}
