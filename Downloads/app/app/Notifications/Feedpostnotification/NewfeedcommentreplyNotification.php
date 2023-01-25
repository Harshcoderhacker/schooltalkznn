<?php

namespace App\Notifications\Feedpostnotification;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class NewfeedcommentreplyNotification extends Notification
{
    use Queueable;

    protected $feedcommentreply, $fullname, $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($feedcommentreply, $fullname, $message)
    {
        $this->feedcommentreply = $feedcommentreply;
        $this->fullname = $fullname;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'firebase'];
    }

    public function toFirebase($notifiable)
    {
        $devicetoken = null;
        if ($notifiable->usertype == 'STUDENT') {
            $devicetoken = $notifiable->aparent?->devicetokenable ? $notifiable->aparent->devicetokenable->pluck('token')->toArray() : null;
        } else {
            $devicetoken = $notifiable->devicetokenable ? $notifiable->devicetokenable->pluck('token')->toArray() : null;
        }

        if ($devicetoken) {
            return (new FirebaseMessage)
                ->withTitle($this->fullname)
                ->withBody($this->message)
                ->withPriority('high')
                ->withAdditionalData([
                    'uuid' => $this->feedcommentreply->feedpost->uuid,
                    'type' => 'FEEDPOST',
                    'typeflag' => 1,
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
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
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
            'uuid' => $this->feedcommentreply->uuid,
            'type' => 'FEEDPOST',
            'typeflag' => 1,
            'fullname' => $this->fullname,
            'message' => $this->message,
            'usertype' => $this->feedcommentreply->feedcommentreplyable->usertype,
            'user_id' => $this->feedcommentreply->feedcommentreplyable->id,

            //CUSTOM
            'type_two' => 'FEEDPOSTREPLY',
            'feedpost_id' => $this->feedcommentreply->feedpost->id,
        ];
    }
}
