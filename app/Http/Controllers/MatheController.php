<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;
use App\Notifications\NhapNoti;
use App\Notifications\ShipNoti;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Notification;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\DonhangGallery;
use App\User;
use App\Bank;
use App\Trangthai;
use App\Loaiship;
use App\LoaiBH;
use App\Coso;
use App\Color;
use App\Dungluong;
use App\History;
use Charts;
use Excel;

class MatheController extends Controller
{

	
	// mã thẻ
	
	 public function mathe(Request $request)
    {
        $tukhoa = $request->tukhoa;
        $datefilter = $request->datefilter;
        $tg=explode(" - ", $datefilter);
		$user=Auth::user();
		
					
			if($user->super == 1){
				$mathe = DonhangGallery::orderBy('id', 'desc')->where('id_loaiship','1')->where('ma_the','<>',0)->where('so_dt','like',"%$tukhoa")->paginate(15);
			}elseif($datefilter == null){
				$mathe = DonhangGallery::where('id_user',$user->id)->orderBy('id', 'desc')->where('ma_the','<>',0)->where('id_loaiship','1')->whereNull('is_mathe')
															->where('so_dt','like',"%$tukhoa")->paginate(15);
			}
			else{
				$mathe = DonhangGallery::where('id_user',$user->id)->orderBy('id', 'desc')->where('ma_the','<>',0)->where('id_loaiship','1')->whereNull('is_mathe')->whereBetween('created_at',$tg)
					->paginate(15);
			}

						
        return view('mathe',compact('mathe'));
    }

    public function checkbox($par = NULL, $par2 = NULL)
    {
		            if ($par == "status") {
                    $par2 == 'true' ? $number = 3 : $number = null;
                    DB::table('donhang')
                            ->where('id', $_GET['id'])
                            ->update(['is_mathe' => $number]);
                    echo 'true';
                    exit();
                }
        return ;
    }
	
	
    public function getmathe($id) {

        $mathe=DonhangGallery::find($id);
        return view('layouts.notemathe',compact('mathe'));
    }
	
	  public function pmathe(Request $request,$id) {
	
				$mathe=DonhangGallery::find($id);
				if($request->mt_note ==! null){
				$mathe->mt_note = $request->mt_note;
				$mathe->save();
				}
			return redirect('mathe');
	  }
	
	

}
