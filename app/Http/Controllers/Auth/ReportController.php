<?php

namespace App\Http\Controllers\Auth;

use App\Bank;
use App\Color;
use App\Coso;
use App\DonhangGallery;
use App\Dungluong;
use App\History;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\LoaiBH;
use App\Loaiship;
use App\Notifications\InvoicePaid;
use App\Notifications\NhapNoti;
use App\Notifications\ShipNoti;
use App\Trangthai;
use App\User;
use Carbon\Carbon;
use Charts;
use DateTime;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Notification;

class ReportController extends Controller
{
    public function export(Request $request)
    {
        $name = new DateTime();
        $datefilter = $request->datefilter;
        $tg = explode(" - ", $datefilter);
        if ($datefilter == null) {
            $donhang = DonhangGallery::orderBy('id', 'desc')->join('loaiship', 'donhang.id_loaiship', '=', 'loaiship.idsp')->join('trangthai', 'donhang.trang_thai', '=', 'trangthai.idtt')->join('shipper', 'donhang.id_shipper', '=', 'shipper.id_sp')->where('trang_thai', '2')->where('id_loaiship', '<>', '3')->select('id as STT', 'loai_ship as Loại Ship', 'ho_ten as Tên người nhận', 'dia_chi as Địa chỉ người nhận', 'so_dt as Số điện thoại', 'so_tien as Tiền thu hộ', 'ma_vd as MaVD')->get();
        } else {
            $donhang = DonhangGallery::orderBy('id', 'desc')->whereBetween('created_at', $tg)->join('loaiship', 'donhang.id_loaiship', '=', 'loaiship.idsp')->join('trangthai', 'donhang.trang_thai', '=', 'trangthai.idtt')->join('shipper', 'donhang.id_shipper', '=', 'shipper.id_sp')->where('trang_thai', '2')->where('id_loaiship', '<>', '3')->select('id as STT', 'loai_ship as Loại Ship', 'ho_ten as Tên người nhận', 'dia_chi as Địa chỉ người nhận', 'so_dt as Số điện thoại', 'so_tien as Tiền thu hộ', 'ma_vd as MaVD')->get();
        }
        return Excel::create( 'Báo cáo ngày:'.$name->format('Y-m-d H:i:s'), function ($excel) use ($donhang){
            $excel->sheet('Excel sheet', function($sheet) use ($donhang) {
                $sheet->fromArray($donhang);
            });
        })->download('xls');
    }

    public function import(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    if ($value->stt !== null && $value->mavd == !null) {
                        $donhang = DonhangGallery::find($value->stt);
                        $donhang->trang_thai = '4';
                        $donhang->ma_vd = $value->mavd;
                        $donhang->save();
                    }
                }
            }
        }
        return back();

    }

    public function report(Request $request)
    {
        $datefilter = $request->datefilter;
        $tg = explode(" - ", $datefilter);
        if ($datefilter == null) {
            $report = DonhangGallery::orderBy('id', 'desc')->paginate(30);
        } else {
            $report = DonhangGallery::orderBy('id', 'desc')->whereBetween('created_at', $tg)->paginate(30);
        }
        return view('report', compact('report', 'datefilter'));
    }


}
