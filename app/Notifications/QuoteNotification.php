<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $quoteData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quoteData)
    {
        $this->quoteData = $quoteData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                ->greeting($this->quoteData['greeting'])
                ->line($this->quoteData['body'])
                ->line($this->quoteData['list'])
                ->line($this->quoteData['thanks']);
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
            'quote_id' => $this->quoteData['quote_id']
        ];
    }
}
