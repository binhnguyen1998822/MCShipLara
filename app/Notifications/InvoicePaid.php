<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoicePaid extends Notification
{
    use Queueable;


    public function __construct($noti,$dk)
    {
        $this->noti = $noti;
        $this->user = $dk;
    }


    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase(){
        return[
            'id'=>$this->noti->id,
            'user'=>$this->user->name,
            'data'=>'Cập nhập đơn',


        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
                'id'=>$this->noti->id,
                'user'=>$this->user->name,
                'data'=>'Cập nhập đơn',

            ]
        ];
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
