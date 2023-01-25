<?php

namespace App\Notifications\FCMbroadcastnotification;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class FcmpushnotificationNotification extends Notification
{
    use Queueable;

    protected $title, $body, $uuid;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($title, $body, $uuid)
    {
        $this->title = $title;
        $this->body = $body;
        $this->uuid = $uuid;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {

        $devicetoken = $notifiable->devicetokenable ? $notifiable->devicetokenable->pluck('token')->toArray() : null;

        if ($devicetoken) {
            return (new FirebaseMessage)
                ->withTitle($this->title)
                ->withBody($this->body)
                ->withPriority('high')
                ->withAdditionalData([
                    'uuid' => $this->uuid,
                    'type' => 'Brodcast',
                ])
                ->asNotification($devicetoken);
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

    }
}
