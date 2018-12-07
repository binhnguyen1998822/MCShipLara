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

class BuudienController extends Controller
{
  
    public function post(Request $request)
    {
        $datefilter = $request->datefilter;
        if($datefilter == null){
            $datefilter = date("1998/12/01 0:00:00").' - ' .date("Y/m/d H:i:s");
            $tg=explode(" - ", $datefilter);
        }else{
            $tg=explode(" - ", $datefilter);
        }
        $loaiship=Loaiship::get();
        $trangthai =Trangthai::get();
        $loaibh=LoaiBH::get();
        $cachesearch= $request;
        $post = DonhangGallery::orderBy('id', 'desc')->where('id_loaiship','<>','3')->whereBetween('created_at',$tg)
            ->where('so_dt','LIKE', $request->so_dt)
            ->where('id_loaiship','LIKE', $request->id_loaiship)
            ->where('trang_thai','LIKE', $request->trang_thai)
            ->where('id_bh','LIKE', $request->id_bh)->whereNotNull('ma_vd')->paginate(40);
		
        return view('post',compact('post','cachesearch','trangthai','loaiship','loaibh'));
    }
	
	    public function checkbox($par = NULL, $par2 = NULL)
    {
		            if ($par == "status") {
                    $par2 == 'true' ? $number = 4 : $number = 6;
                    DB::table('donhang')
                            ->where('id', $_GET['id'])
                            ->update(['trang_thai' => $number]);
                    echo 'true';
                    exit();
                }
        return ;
    }  
	
	public function checkbox1($par = NULL, $par2 = NULL)
    {
		            if ($par == "status") {
                    $par2 == 'true' ? $number = 5 : $number = 5;
                    DB::table('donhang')
                            ->where('id', $_GET['id'])
                            ->update(['trang_thai' => $number]);
                    echo 'true';
                    exit();
                }
        return ;
    }


}
