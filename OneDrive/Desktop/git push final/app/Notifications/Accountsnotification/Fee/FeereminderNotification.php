<?php

namespace App\Notifications\Accountsnotification\Fee;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class FeereminderNotification extends Notification
{
    use Queueable;

    protected $student, $fullname, $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($student, $fullname, $message)
    {
        $this->student = $student;
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
        $devicetoken = $notifiable->devicetokenable ? $notifiable->devicetokenable->pluck('token')->toArray() : null;

        if ($devicetoken) {
            return (new FirebaseMessage)
                ->withTitle($this->fullname)
                ->withBody($this->message)
                ->withPriority('high')
                ->withAdditionalData([
                    'uuid' => $this->student->uuid,
                    'type' => 'FEE',
                    'typeflag' => 4,
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
            'uuid' => $this->student->uuid,
            'type' => 'FEE',
            'typeflag' => 2,
            'fullname' => $this->fullname,
            'message' => $this->message,
            'usertype' => $notifiable->usertype,
            'user_id' => $notifiable->id,

            //CUSTOM
            'type_two' => 'FEEREMINDER',
            // 'homework_id' => $this->homeworklist->homework->id,
            // 'homeworklist_id' => $this->homeworklist->id,
        ];
    }
}
