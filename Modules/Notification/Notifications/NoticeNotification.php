<?php

namespace Modules\Notification\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NoticeNotification extends Notification
{
    use Queueable;

    private $noticeData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($noticeData)
    {
        $this->noticeData = $noticeData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        
        return (new MailMessage)                    
            ->line($this->noticeData['name'])
            ->line(new HtmlString($this->noticeData['body']))
            ->action($this->noticeData['noticeText'], $this->noticeData['noticeUrl'])
            ->line($this->noticeData['thanks']);
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
            'notice_id' => $this->noticeData['notice_id'],
        ];
    }
}
