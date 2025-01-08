<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Clacker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewClacker extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Clacker $clacker)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("New Clacker from {$this->clacker->user->name}")
                    ->greeting("New Clacker from {$this->clacker->user->name}")
                    ->line(Str::limit($this->clacker->message, 50))
                    ->action('Go to Clacker', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
