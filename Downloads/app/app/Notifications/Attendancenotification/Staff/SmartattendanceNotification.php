<?php

namespace App\Notifications\Attendancenotification\Staff;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class SmartattendanceNotification extends Notification
{
    use Queueable;

    protected $smartattendance, $fullname, $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($smartattendance, $fullname, $message)
    {
        $this->smartattendance = $smartattendance;
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
                    'uuid' => $this->smartattendance->uuid,
                    'type' => 'ATTENDANCE',
                    'typeflag' => 3,
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
            'uuid' => $this->smartattendance->uuid,
            'type' => 'ATTENDANCE',
            'typeflag' => 3,
            'fullname' => $this->fullname,
            'message' => $this->message,
            'usertype' => $notifiable->usertype,
            'user_id' => $notifiable->id,

            //CUSTOM
            'type_two' => 'SMARTATTENDANCE',
            'smartattendance_id' => $this->smartattendance->id,
            'staff_id' => $this->smartattendance->staff_id,

        ];
    }
}
