<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Khachhang;
use Excel;

class KhachhangController extends Controller
{
    public function khachhang(Request $request)
    {
				
		$datefilter = $request->datefilter;
		$tg=explode(" - ", $datefilter);
		
		if ( $datefilter == null) {
			$khachhangmua = Khachhang::join('donhang', 'donhang.so_dt', '=', 'khachhang.phone')->groupBy('id_kh')->orderBy('id_kh', 'desc')->paginate(15);
		}else{
				$khachhangmua = Khachhang::join('donhang', 'donhang.so_dt', '=', 'khachhang.phone')->groupBy('id_kh')->orderBy('id_kh', 'desc')->paginate(15);
		}
		
		

		if ( $datefilter == null) {
			$khachhang = Khachhang::orderBy('id_kh', 'desc')->paginate(15);
		}else{
			$khachhang = Khachhang::orderBy('id_kh', 'desc')->whereBetween('created_at', $tg)->paginate(15);
		}
		 return view('khachhang',compact('khachhang','khachhangmua')); 
    }

	
	 public function ekhachhang($id_kh) {

        $khachhang = Khachhang::find($id_kh);
        return view('layouts.note',compact('khachhang'));
    }

    public function pkhachhang(Request $request,$id_kh) {
		
        $status=Khachhang::find($id_kh);
		
		if($request->ghichu ==! null){
        $status->ghichu = $request->ghichu;
	}
        $status->save();
        return redirect('khachhang');

    }


}
