<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NhapNoti extends Notification 
{
    use Queueable;

 
    public function __construct($noti,$donhang)
    {
        $this->noti = $noti;
		$this->donhang = $donhang;
    }


    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

	public function toDatabase(){
		return[
				'id'=>$this->donhang->id,
                'user'=>$this->noti->name,
                'data'=>'Đã thêm đơn hàng mới'
		];
	}

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
				'id'=>$this->donhang->id,
                'user'=>$this->noti->name,
                'data'=>'Đã thêm đơn hàng mới'
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
