<?php

namespace App\Http\Controllers;
use App\DonhangGallery;
use App\Hoahong;
use App\MyIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Notification;
use App\Http\Requests;
use Charts;

class ProfileController extends Controller
{

    public function profile(Request $request){
        $datefilter = $request->datefilter;
        $tg=explode(" - ", $datefilter);
        $user=Auth::user();
		$timethis = date("Y/m/1 0:00:00").' - ' .date("Y/m/d H:i:s"); 
		// tính hoa hồng
		$sbhv = Hoahong::pluck('hh_bhv');
		$smayban=Hoahong::pluck('hh_mayban');
		$sphukien=Hoahong::pluck('hh_phukien');
		
		foreach($sbhv as &$sbhv){
			   $sbhv = (int) $sbhv;     
		}    
		foreach($smayban as &$smayban){
			   $smayban = (int) $smayban;      
		}    
		foreach($sphukien as &$sphukien){
			   $sphukien = (int) $sphukien;
		}    
		
		
        if($datefilter == null){
			$datefilter = date("Y/m/1 0:00:00").' - ' .date("Y/m/d H:i:s"); 
			$tg=explode(" - ", $timethis);
			//đếm cơ sở nhận
			$coundcoso=DonhangGallery::select('co_so',DB::raw('COUNT(co_so) as socoso'))->where('id_user',$user->id)->groupBy('co_so')->whereBetween('created_at',$tg)->get();
			
			$tongmay=DonhangGallery::where('id_user',$user->id)->where('trang_thai','<>','5')->whereBetween('created_at',$tg)->count();
            $coundabht=DonhangGallery::where('id_bh','1')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
            $coundabhv=DonhangGallery::where('id_bh','2')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
            $coundpk=DonhangGallery::where('id_bh','3')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
			
			$coundshipcod=DonhangGallery::where('id_loaiship','1')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
            $coundshipxa=DonhangGallery::where('id_loaiship','2')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
			$coundshipnt=DonhangGallery::where('id_loaiship','3')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
			
            $thongke=DonhangGallery::where('id_user',$user->id)
				->where('trang_thai','<>','5')
                ->whereBetween('created_at',$tg)
                ->select('ten_may','sp_color','sp_dungluong','ram','id_loaiship','id_bh',DB::raw('count(sp_color) as soluong'))
                ->groupBy('ten_may','sp_color','sp_dungluong','ram','id_loaiship','id_bh')
                ->get();
				

        }else{
			
			$coundcoso=DonhangGallery::select('co_so',DB::raw('COUNT(co_so) as socoso'))->where('id_user',$user->id)->groupBy('co_so')->whereBetween('created_at',$tg)->get();
			
			$tongmay=DonhangGallery::where('id_user',$user->id)->where('trang_thai','<>','5')->whereBetween('created_at',$tg)->count();
            $coundabht=DonhangGallery::where('id_bh','1')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
            $coundabhv=DonhangGallery::where('id_bh','2')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
            $coundpk=DonhangGallery::where('id_bh','3')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
			
			$coundshipcod=DonhangGallery::where('id_loaiship','1')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
            $coundshipxa=DonhangGallery::where('id_loaiship','2')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
			$coundshipnt=DonhangGallery::where('id_loaiship','3')->where('trang_thai','<>','5')->where('id_user',$user->id)->whereBetween('created_at',$tg)->count();
			
            $thongke=DonhangGallery::where('id_user',$user->id)
				->where('trang_thai','<>','5')
                ->whereBetween('created_at',$tg)
                ->select('ten_may','sp_color','sp_dungluong','ram','id_loaiship','id_bh',DB::raw('count(sp_color) as soluong'))
                ->groupBy('ten_may','sp_color','sp_dungluong','ram','id_loaiship','id_bh')
                ->get();
        }
			//lợi nhuận
		$tm=$tongmay*$smayban;
		$mbhv=$coundabhv*$sbhv;
		$mbht=$coundabht*$smayban;
		$lnpk=$coundpk*$sphukien;
		$tln=($mbhv+$tm+$lnpk);
		
		// kiểm tra ip
		$mip=$request->ip();
		$ip1='1.52.130.132';
		$ip2='';
		$ip3='';
			//if($mip== $ip1 || $mip== $ip2 || $mip== $ip3){
            return view('profile',compact('thongke','coundabht','coundabhv','coundpk','datefilter','tongmay','tm','mbhv','mbht','tln','lnpk','coundshipcod','coundshipxa','coundshipnt','coundcoso'));
			//}
			//else{
				   //return redirect('dashboard');
			//}
    }
}
