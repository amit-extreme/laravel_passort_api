<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetRequest extends Notification implements ShouldQueue
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
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
        $url = url('/api/v1/find/'.$this->token);

        return (new MailMessage)
                    ->subject(__('MechTech-SMS password reset request'))
                    ->line(__('Hello!'.' '. $notifiable->name))
                    ->line(__('you recently requested to reset your password for your'))
                    ->line(__('MechTech-SMS account. Click the button below to reset it.'))
                    ->action(__('Reset your password'), url($url))
                    ->line(__('if you did not request a password reset,please ignore this email or'))
                    ->line(__('reply to let us know. this password reset is only valid for the next'))
                    ->line(__('minutes'))
                    ->line(__('Thanks,'))
                    ->line(__('MechTech-SMS Team'));
    }
}
