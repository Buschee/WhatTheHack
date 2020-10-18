<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChangeEmail extends Notification implements ShouldQueue
{
    use Queueable;
    private $user_id;
    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id, $token)
    {
        $this->user_id = $id;
        $this->token = $token;
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
        $url = url('/profile/email/change/' . $this->user_id . '/' . $this->token);

        return (new MailMessage)
                    ->from('email.whatthehack@gmail.com', 'WTH Team')
                    ->line('You are receiving this email because we received an email change request for your account.')
                    ->subject('Change E-Mail Request')
                    ->action('Change E-Mail', url($url))
                    ->line('If you did not request an email change, no further action is required!')
                    ->line('This change request will be expired in 30min!');
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
            //
        ];
    }
}
