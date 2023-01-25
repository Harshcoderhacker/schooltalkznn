<?php

namespace App\Notifications\Homeworknotification;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class HomeworkcommentNotification extends Notification
{
    use Queueable;

    protected $homeworkcomment, $fullname, $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($homeworkcomment, $fullname, $message)
    {
        $this->homeworkcomment = $homeworkcomment;
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
            $devicetoken = $notifiable->aparent->devicetokenable ? $notifiable->aparent->devicetokenable->pluck('token')->toArray() : null;
        } else {
            $devicetoken = $notifiable->devicetokenable ? $notifiable->devicetokenable->pluck('token')->toArray() : null;
        }

        if ($devicetoken) {
            return (new FirebaseMessage)
                ->withTitle($this->fullname)
                ->withBody($this->message)
                ->withPriority('high')
                ->withAdditionalData([
                    'uuid' => $this->homeworkcomment->homework->uuid,
                    'type' => 'HOMEWORKCOMMENT',
                    'typeflag' => 2,
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
            'uuid' => $this->homeworkcomment->uuid,
            'type' => 'HOMEWORK',
            'fullname' => $this->fullname,
            'message' => $this->message,
            'usertype' => $this->homeworkcomment->homeworkcommentable->usertype,
            'user_id' => $this->homeworkcomment->homeworkcommentable->id,

            //CUSTOM
            'type_two' => 'HOMEWORKCOMMENT',
            'homework_id' => $this->homeworkcomment->homework->id,
            'homeworklist_id' => $this->homeworkcomment->homeworklist->id,
            'homeworkcomment_id' => $this->homeworkcomment->id,

        ];
    }
}
