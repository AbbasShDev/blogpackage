<?php

namespace AbbasShDev\BlogPackage\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use AbbasShDev\BlogPackage\Models\Post;

class PostWasPublishedNotification extends Notification
{
    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return config('blogpackage.notifications.channels');
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
            ->line("Your post '{$this->post->title}' was accepted")
            ->action('Notification Action', url("/posts/{$this->post->id}"))
            ->line('Thank you for using our application!');
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