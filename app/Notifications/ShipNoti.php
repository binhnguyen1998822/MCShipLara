<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ShipNoti extends Notification 
{
    use Queueable;

 
    public function __construct($donhang)
    {
     $this->donhang = $donhang;
    }


    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

	public function toDatabase(){
		return[
				'id'=>$this->donhang->id,
				'user'=>$this->donhang->shipper->sp_name,
                'data'=>$this->donhang->trangthai->ten_trangthai
		];
	}

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
				'id'=>$this->donhang->id,
				'user'=>$this->donhang->shipper->sp_name,
                'data'=>$this->donhang->trangthai->ten_trangthai
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
