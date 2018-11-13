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

class UsersController extends Controller
{
	
    public function test(Request $request)
    {
		$timethis = date("Y/m/1 0:00:00").' - ' .date("Y/m/d H:i:s"); 
        return  $timethis;
    }

    public function json_dh()
    {
        $donhang = DonhangGallery::orderBy('id', 'desc')->where('id_loaiship','3')->get();
        return $donhang;
    }
    public function json_donship()
    {
		$don=DonhangGallery::select('id_shipper',DB::raw('COUNT(id_shipper) as sodon'))->where('trang_thai','4')->groupBy('id_shipper')->get();
        return $don;
    }

    //xuất exel
    public function export(Request $request)
    {
		$datefilter = $request->datefilter;
        $name = new DateTime();
        if($datefilter == null){
            $datefilter = date("1998/12/01 0:00:00").' - ' .date("Y/m/d H:i:s");
            $tg=explode(" - ", $datefilter);
        }else{
            $tg=explode(" - ", $datefilter);
        }

        $donhang = DonhangGallery::join('loaiship', 'donhang.id_loaiship', '=', 'loaiship.idsp')
            ->join('trangthai', 'donhang.trang_thai', '=', 'trangthai.idtt')
            ->join('shipper', 'donhang.id_shipper', '=', 'shipper.id_sp')
            ->select('id as Mã đơn','ho_ten as Tên khách hàng','so_dt as Số điện thoại','dia_chi as Địa chỉ','ten_may as Sản phẩm','sp_color as Màu sắc','imei as IMEI','phukien as Phụ kiện','ten_trangthai as Trạng thái','loai_ship as Loại Ship','so_tien as Tổng tiền','ten_user as Người nhập','sp_name as Người giao hàng','created_at as Ngày bán')
            ->whereBetween('created_at',$tg)
            ->where('so_dt','LIKE', $request->so_dt)
            ->where('id_loaiship','LIKE', $request->id_loaiship)
            ->where('trang_thai','LIKE', $request->trang_thai)
            ->orderBy('id', 'desc')
            ->get();

            return Excel::create( $name->format('Y-m-d H:i:s'), function ($excel) use ($donhang){
                $excel->sheet('Excel sheet', function($sheet) use ($donhang) {

                    $sheet->fromArray($donhang);
                });
            })->download('xls');


    }

// Hiển thị đơn hàng


    public function donhang(Request $request)
    {
		$user=Auth::user();
        $datefilter = $request->datefilter;
        if($datefilter == null){
            $datefilter = date("1998/12/01 0:00:00").' - ' .date("Y/m/d H:i:s");
            $tg=explode(" - ", $datefilter);
        }else{
            $tg=explode(" - ", $datefilter);
        }

        $loaibh=LoaiBH::get();
        $loaiship=Loaiship::get();
        $bank =Bank::get();
		$coso =Coso::get();
		$color =Color::get();
		$dungluong =Dungluong::get();
		$trangthai =Trangthai::get();

        $cachesearch= $request;
		if($user->nhom == 'LeTan' ){
			if($datefilter == null){
				$donhang = DonhangGallery::orderBy('id', 'desc')->where('id_loaiship','3')
					->join('loaiship', 'donhang.id_loaiship', '=', 'loaiship.idsp')
					->paginate(15);
			}else{
				$donhang = DonhangGallery::orderBy('id', 'desc')->whereBetween('created_at',$tg)->where('id_loaiship','3')
					->paginate(15);
			}
		}
		else{
            $donhang = DonhangGallery::orderBy('id', 'desc')
                ->whereBetween('created_at',$tg)
                ->where('so_dt','LIKE', $request->so_dt)
                ->where('id_loaiship','LIKE', $request->id_loaiship)
                ->where('trang_thai','LIKE', $request->trang_thai)
                ->where('id_bh','LIKE', $request->id_bh)
                ->paginate(15);
		}
        return view('donhang',compact('cachesearch','donhang','bank','loaiship','loaibh','coso','color','dungluong','datefilter','trangthai'));
    }


//Nhập dữ liệu đơn hàng

    public function nhapdl(Request $request)
    {
		$userthis=Auth::user();
		
		$donhang = new DonhangGallery();
		$donhang->trang_thai  = "1";
		$donhang->id_shipper  = "0";
		$donhang->is_post  = "2";
		$donhang->ten_user  = $userthis->name;
		$donhang->nhom  = $userthis->nhom;
		$donhang->id_user  = $userthis->id;
		$donhang->ma_the  = $request->ma_the;
		$donhang->id_loaiship  = $request->id_loaiship;
		$donhang->nganhang  = $request->nganhang;
		$donhang->ho_ten  = $request->ho_ten;
		$donhang->so_dt  = $request->so_dt;
		$donhang->dia_chi  = $request->dia_chi;
		$donhang->ten_may  = $request->ten_may;
		$donhang->sp_color  = $request->sp_color;
		$donhang->id_bh  = $request->id_bh;
		$donhang->thang_bh  = $request->thang_bh;
		$donhang->so_tien  = $request->so_tien;
		$donhang->ghi_chu  = $request->ghi_chu;
		$donhang->phukien  = $request->phukien;
		$donhang->co_so  = $request->co_so;
		$donhang->sp_dungluong  = $request->sp_dungluong;
		$donhang->ram  = $request->ram;
		$donhang->ma_seri  = $request->ma_seri;
		$donhang->save();
    
        $noti=Auth::user();
        $user =User::where('id','<>', $noti->id)->get();
        Notification::send($user, new NhapNoti($noti,$donhang));
		//lưu lịch sử nhập
		$this->historynhap($donhang);
		
        Session::flash('message', 'Bạn vừa thêm một đơn mới!');
        return back()->with('success','Đã thêm đơn.');
    }
//Lịch sử Nhập dữ liệu đơn hàng

    public function historynhap($donhang)
    {
		$history = new History;
		$history->id_hd= $donhang->id;
		$history->trang_thai  = $donhang->trang_thai;
		$history->id_shipper  = $donhang->id_shipper;
		$history->ten_user  = $donhang->ten_user;
		$history->nhom  = $donhang->nhom;
		$history->id_user  = $donhang->id_user;
		$history->ma_the  = $donhang->ma_the;
		$history->id_loaiship  = $donhang->id_loaiship;
		$history->nganhang  = $donhang->nganhang;
		$history->ho_ten  = $donhang->ho_ten;
		$history->so_dt  = $donhang->so_dt;
		$history->dia_chi  = $donhang->dia_chi;
		$history->ten_may  = $donhang->ten_may;
		$history->sp_color  = $donhang->sp_color;
		$history->id_bh  = $donhang->id_bh;
		$history->thang_bh  = $donhang->thang_bh;
		$history->so_tien  = $donhang->so_tien;
		$history->ghi_chu  = $donhang->ghi_chu;
		$history->phukien  = $donhang->phukien;
		$history->co_so  = $donhang->co_so;
		$history->sp_dungluong  = $donhang->sp_dungluong;
		$history->ram  = $donhang->ram;
		$history->ma_seri  = $donhang->ma_seri;
		$history->save();
        return ;
    }

//Trạng thái

    public function status($id) {

        $status=DonhangGallery::find($id);
        $trangthai =Trangthai::get();
        $bank =Bank::get();
        $color =Color::get();
        return view('layouts.status',compact('status','trangthai','bank','color'));
    }

    public function pstatus(Request $request,$id) {
		
        $status=DonhangGallery::find($id);
		
		if($request->nganhang ==! null){
        $status->nganhang = $request->nganhang;
		}
		if($request->id_bh ==! null){
        $status->id_bh = $request->id_bh;
		}
		if($request->ma_the ==! null){
        $status->ma_the = $request->ma_the;
		}
		if($request->so_tien ==! null){
        $status->so_tien = $request->so_tien;
		}
		if($request->trang_thai ==! null){
        $status->trang_thai = $request->trang_thai;
		}
		if($request->ma_vd ==! null){
        $status->ma_vd = $request->ma_vd;
		}
		if($request->imei ==! null){
        $status->imei = $request->imei;
		}
		if($request->ho_ten ==! null){
        $status->ho_ten = $request->ho_ten;
		}
		if($request->so_dt ==! null){
        $status->so_dt = $request->so_dt;
		}
		if($request->dia_chi ==! null){
        $status->dia_chi = $request->dia_chi;
		}
		if($request->sp_color ==! null){
        $status->sp_color = $request->sp_color;
		}
		if($request->sp_dungluong == !null){
        $status->sp_dungluong = $request->sp_dungluong;
		}
		if($request->ten_may == !null){ 
        $status->ten_may = $request->ten_may;
		}
		if($request->ram == !null){ 
        $status->ram = $request->ram;
		}
		if($request->thang_bh == !null){ 
        $status->thang_bh = $request->thang_bh;
		}
		if($request->ghi_chu == !null){
        $status->ghi_chu = $request->ghi_chu;
		}
		if($request->phukien == !null){
        $status->phukien = $request->phukien;
		}
		      
        $status->save();
		
        $dk=Auth::user();
        $user =User::where('id','<>', $dk->id)->get();
        $noti=DonhangGallery::find($id);
        Notification::send($user, new InvoicePaid($noti,$dk));
        Session::flash('message', $status->trangthai->ten_trangthai.'!');
		$this->sentNoti($noti);
		$this->history($request);
        return back();

    }
	
	    public function history($request)
    {
		$userthis=Auth::user();
        $history = new History;
		$history->id_hd= $request->id_dh;
		
		if($request->id_bh ==! null){
        $history->id_bh = $request->id_bh;
		}	
		if($request->thang_bh ==! null){
        $history->thang_bh = $request->thang_bh;
		}	
		if($request->ma_the ==! null){
        $history->ma_the = $request->ma_the;
		}
		if($request->ma_seri ==! null){
        $history->ma_seri = $request->ma_seri;
		}	
		if($request->so_tien ==! null){
        $history->so_tien = $request->so_tien;
		}
		if($request->nganhang ==! null){
        $history->nganhang = $request->nganhang;
		}
		if($request->trang_thai ==! null){
        $history->trang_thai = $request->trang_thai;
		}
		if($request->ma_vd ==! null){
        $history->ma_vd = $request->ma_vd;
		}
		if($request->imei ==! null){
        $history->imei = $request->imei;
		}
		if($request->ho_ten ==! null){
        $history->ho_ten = $request->ho_ten;
		}
		if($request->so_dt ==! null){
        $history->so_dt = $request->so_dt;
		}
		if($request->dia_chi ==! null){
        $history->dia_chi = $request->dia_chi;
		}
		if($request->sp_color ==! null){
        $history->sp_color = $request->sp_color;
		}
		if($request->sp_dungluong == !null){
        $history->sp_dungluong = $request->sp_dungluong;
		}
		if($request->ten_may == !null){
        $history->ten_may = $request->ten_may;
		}
		if($request->ram == !null){ 
        $history->ram = $request->ram;
		}	
	
        $history->id_user = $userthis->id;
		
		
		$history->save();
        return ;
    }

	
	    public function notiship(Request $request)
    {
		$donhang = DonhangGallery::find($request->input('id'));
        $donhang->trang_thai= $request->input('trang_thai');
		$donhang->id_shipper= $request->input('id_shipper');
        $donhang->save();
		
        $user =User::get();
        Notification::send($user, new ShipNoti());
        return ;
    }
//xóa đơn hàng
    public function deldonhang($id)
    {
        DB::delete('delete from donhang where id = ?',[$id]);

        Session::flash('message', 'Xóa đơn hàng thành công!');
        return redirect('donhang');
    }

    public function sentNoti($noti) {

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $fields = array(
            "to" => "/topics/NTB",
            'data' => $noti
        );
        $headers = array();

        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AAAA9EXed6I:APA91bEIOCtRw4FjYYTXxBwQnCSpRoGfVE5UvQkLd31E-v-pcpiUp5JYQfWfO0iO6XOGg9y2wfauaJMQeu21SE2KWoiLJLKKKjAYh3hzzvC6rNbrELm2yovoRXAzYwElstjDqSUuSGaP';

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
	
	
	//đơn hàng shipper
		public function donhangship(Request $request)
    {
		$timethis = date("Y/m/1 0:00:00").' - ' .date("Y/m/d H:i:s"); 
		$datefilter = $request->datefilter;
		 if($datefilter == null){
				$tg=explode(" - ", $timethis);
				$donship = DonhangGallery::select('id_shipper',DB::raw('COUNT(id_shipper) as sodon'))->where('trang_thai','4')->groupBy('id_shipper')->where('id_shipper','<>', '0')->whereBetween('created_at',$tg)->get();
				return view('donship',compact('donship'));
		 }
		 else{
				$tg=explode(" - ", $datefilter);
				$donship = DonhangGallery::select('id_shipper',DB::raw('COUNT(id_shipper) as sodon'))->where('trang_thai','4')->groupBy('id_shipper')->where('id_shipper','<>', '0')->whereBetween('created_at',$tg)->get();
				return view('donship',compact('donship'));
		 }
    }
	

}
