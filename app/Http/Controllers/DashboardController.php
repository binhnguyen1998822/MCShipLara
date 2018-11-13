<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Color;
use App\Coso;
use App\DonhangGallery;
use App\Dungluong;
use App\Hoahong;
use App\Http\Requests;
use App\LoaiBH;
use App\Loaiship;
use App\Notifications\InvoicePaid;
use App\Notifications\NhapNoti;
use App\Trangthai;
use Carbon\Carbon;
use Charts;
use DateInterval;
use DatePeriod;
use DateTime;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notification;

class DashboardController extends Controller
{

    public function mainview(Request $request)
    {
        //lọc
        $datefilter = $request->datefilter;
        $tg = explode(" - ", $datefilter);
        $range = Carbon::now()->subDays(30);
        // tính hoa hồng
        $sbhv = Hoahong::pluck('hh_bhv');
        $smayban = Hoahong::pluck('hh_mayban');
        $sphukien = Hoahong::pluck('hh_phukien');

        foreach ($sbhv as &$sbhv) {
            $sbhv = (int)$sbhv;
        }
        foreach ($smayban as &$smayban) {
            $smayban = (int)$smayban;
        }
        foreach ($sphukien as &$sphukien) {
            $sphukien = (int)$sphukien;
        }


        //phongban
        if ($datefilter == null) {

            $datefilter = date("Y/m/01 0:00:00") . ' - ' . date("Y/m/d H:i:s");
            $tg = explode(" - ", $datefilter);

            $donhang = DB::table('donhang')
                ->where('trang_thai', '4')
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->whereBetween('created_at', $tg)
                ->get([
                    DB::raw('Date(created_at) as date'),
                    DB::raw('COUNT(*) as value'),
                    DB::raw("SUM(so_tien) as tongtien")
                ]);

            $dangcho = DonhangGallery::where('trang_thai', '1')->whereBetween('created_at', $tg)->count();
            $xacnhan = DonhangGallery::where('trang_thai', '2')->whereBetween('created_at', $tg)->count();
            $hoanthanh = DonhangGallery::where('trang_thai', '4')->whereBetween('created_at', $tg)->count();
            $vnpost = DonhangGallery::where('trang_thai', '6')->whereBetween('created_at', $tg)->count();
            $facebook = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Facebook')->whereBetween('created_at', $tg)->count();
            $hotline = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();

            $money = DonhangGallery::where('trang_thai', '4')->whereBetween('created_at', $tg)->sum('so_tien');
            $dh = DB::table('donhang')->whereBetween('created_at', $tg)->count();
            $tongtien = number_format($money);

            $donhuy = DB::table('donhang')->where('trang_thai', '5')->whereBetween('created_at', $tg)->count();
            $tongmayfb = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Facebook')->whereBetween('created_at', $tg)->count();
            $coundabhtfb = DonhangGallery::where('trang_thai', '4')->where('id_bh', '1')->whereBetween('created_at', $tg)->where('nhom', 'Facebook')->count();
            $coundabhvfb = DonhangGallery::where('trang_thai', '4')->where('id_bh', '2')->whereBetween('created_at', $tg)->where('nhom', 'Facebook')->count();
            $coundpkfb = DonhangGallery::where('trang_thai', '4')->where('id_bh', '3')->whereBetween('created_at', $tg)->where('nhom', 'Facebook')->count();

            $thongkefb = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Facebook')
                ->whereBetween('created_at', $tg)
                ->select('ten_may', 'sp_color', DB::raw('count(sp_color) as soluong'))
                ->groupBy('ten_may', 'sp_color')
                ->get();
            $tmfb = $tongmayfb * $smayban;
            $mbhvfb = $coundabhvfb * $sbhv;
            $mpkfb = $coundpkfb * $sphukien;
            $tlnfb = number_format($tmfb + $mbhvfb + $mpkfb);

            $tongmayhl = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();
            $coundabhthl = DonhangGallery::where('trang_thai', '4')->where('id_bh', '1')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();
            $coundabhvhl = DonhangGallery::where('trang_thai', '4')->where('id_bh', '2')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();
            $coundpkhl = DonhangGallery::where('trang_thai', '4')->where('id_bh', '3')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();

            $thongkehl = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Hotline')
                ->whereBetween('created_at', $tg)
                ->select('ten_may', 'sp_color', DB::raw('count(sp_color) as soluong'))
                ->groupBy('ten_may', 'sp_color')
                ->get();
            //lợi nhuận
            $tmhl = $tongmayhl * $smayban;
            $mbhvhl = $coundabhvhl * $sbhv;
            $mpkhl = $coundpkhl * $sphukien;
            $tlnhl = number_format($tmhl + $mbhvhl + $mpkhl);

        } else {
            $donhang = DB::table('donhang')
                ->where('trang_thai', '4')
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->whereBetween('created_at', $tg)
                ->get([
                    DB::raw('Date(created_at) as date'),
                    DB::raw('COUNT(*) as value'),
                    DB::raw("SUM(so_tien) as tongtien")
                ]);

            $dangcho = DonhangGallery::where('trang_thai', '1')->whereBetween('created_at', $tg)->count();
            $xacnhan = DonhangGallery::where('trang_thai', '2')->whereBetween('created_at', $tg)->count();
            $hoanthanh = DonhangGallery::where('trang_thai', '4')->whereBetween('created_at', $tg)->count();
            $vnpost = DonhangGallery::where('trang_thai', '6')->whereBetween('created_at', $tg)->count();
            $facebook = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Facebook')->whereBetween('created_at', $tg)->count();
            $hotline = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();

            $money = DonhangGallery::where('trang_thai', '4')->whereBetween('created_at', $tg)->sum('so_tien');
            $dh = DB::table('donhang')->whereBetween('created_at', $tg)->count();
            $tongtien = number_format($money);

            $donhuy = DB::table('donhang')->where('trang_thai', '5')->whereBetween('created_at', $tg)->count();
            $tongmayfb = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Facebook')->whereBetween('created_at', $tg)->count();
            $coundabhtfb = DonhangGallery::where('trang_thai', '4')->where('id_bh', '1')->whereBetween('created_at', $tg)->where('nhom', 'Facebook')->count();
            $coundabhvfb = DonhangGallery::where('trang_thai', '4')->where('id_bh', '2')->whereBetween('created_at', $tg)->where('nhom', 'Facebook')->count();
            $coundpkfb = DonhangGallery::where('trang_thai', '4')->where('id_bh', '3')->whereBetween('created_at', $tg)->where('nhom', 'Facebook')->count();

            $thongkefb = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Facebook')
                ->whereBetween('created_at', $tg)
                ->select('ten_may', 'sp_color', DB::raw('count(sp_color) as soluong'))
                ->groupBy('ten_may', 'sp_color')
                ->get();
            $tmfb = $tongmayfb * $smayban;
            $mbhvfb = $coundabhvfb * $sbhv;
            $mpkfb = $coundpkfb * $sphukien;
            $tlnfb = number_format($tmfb + $mbhvfb + $mpkfb);

            $tongmayhl = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();
            $coundabhthl = DonhangGallery::where('trang_thai', '4')->where('id_bh', '1')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();
            $coundabhvhl = DonhangGallery::where('trang_thai', '4')->where('id_bh', '2')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();
            $coundpkhl = DonhangGallery::where('trang_thai', '4')->where('id_bh', '3')->where('nhom', 'Hotline')->whereBetween('created_at', $tg)->count();

            $thongkehl = DonhangGallery::where('trang_thai', '4')->where('nhom', 'Hotline')
                ->whereBetween('created_at', $tg)
                ->select('ten_may', 'sp_color', DB::raw('count(sp_color) as soluong'))
                ->groupBy('ten_may', 'sp_color')
                ->get();
            //lợi nhuận
            $tmhl = $tongmayhl * $smayban;
            $mbhvhl = $coundabhvhl * $sbhv;
            $mpkhl = $coundpkhl * $sphukien;
            $tlnhl = number_format($tmhl + $mbhvhl + $mpkhl);
        }


        $charttien = Charts::multi('areaspline', 'highcharts')
            ->title(' ')
            ->template("material")
            ->elementLabel("Tổng số")
            ->colors(['#CC99FF', '#FFFF66'])
            ->labels($donhang->pluck('date'))
            ->dataset('Tiền', $donhang->pluck('tongtien'));
        $chartsl = Charts::multi('areaspline', 'highcharts')
            ->title(' ')
            ->template("material")
            ->elementLabel("Tổng số")
            ->labels($donhang->pluck('date'))
            ->dataset('Số lượng', $donhang->pluck('value'));

        $chartdt = Charts::multi('areaspline', 'highcharts')
            ->title(' ')
            ->template("material")
            ->elementLabel("Tổng số")
            ->labels($donhang->pluck('date'))
            ->dataset('Số lượng', $donhang->pluck('value'));
        $chartcount = $this->chartcount($datefilter);
        $chartincome = $this->chartincome($datefilter);

        return view('dashboard', compact('tongtien', 'charttien', 'chartsl', 'chartdt', 'dh', 'donhuy', 'dangcho', 'xacnhan', 'hoanthanh', 'vnpost', 'facebook', 'hotline', 'tlnfb', 'tlnhl', 'datefilter', 'chartcount','chartincome'));

    }

    public function chartcount($datefilter)
    {
        $tg = explode(" - ", $datefilter);

        $begin = new DateTime($tg[0]);
        $end = new DateTime($tg[1]);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);


        $return_arr = [];
        $return_arr['dangcho'] = '';
        $return_arr['xacnhan'] = '';
        $return_arr['thanhcong'] = '';
        $return_arr['huy'] = '';
        $return_arr['danggiao'] = '';
        $return_arr['vnpost'] = '';
        $return_arr['date'] = '';

        $dangcho = DB::table('donhang')
            ->where('trang_thai', '1')
            ->selectRaw('date(created_at) as day, count(id) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        $xacnhan = DB::table('donhang')
            ->where('trang_thai', '2')
            ->selectRaw('date(created_at) as day, count(id) as total')
            ->groupby('day')
            ->pluck('total', 'day');


        $huy = DB::table('donhang')
            ->where('trang_thai', '5')
            ->selectRaw('date(created_at) as day, count(id) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        $thanhcong = DB::table('donhang')
            ->where('trang_thai', '4')
            ->selectRaw('date(created_at) as day, count(id) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        $danggiao = DB::table('donhang')
            ->where('trang_thai', '3')
            ->selectRaw('date(created_at) as day, count(id) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        $vnpost = DB::table('donhang')
            ->where('trang_thai', '6')
            ->selectRaw('date(created_at) as day, count(id) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        foreach ($daterange as $date) {
            $month = $date->format("Y-m-d");
            $dangcho_cnt = (isset($dangcho[$month]) ? $dangcho[$month] : 'null');
            $xacnhan_cnt = (isset($xacnhan[$month]) ? $xacnhan[$month] : 'null');
            $huy_cnt = (isset($huy[$month]) ? $huy[$month] : 'null');
            $thanhcong_cnt = (isset($thanhcong[$month]) ? $thanhcong[$month] : 'null');
            $danggiao_cnt = (isset($danggiao[$month]) ? $danggiao[$month] : 'null');
            $vnpost_cnt = (isset($vnpost[$month]) ? $vnpost[$month] : 'null');

            $return_arr['dangcho'] .= $dangcho_cnt . ',';
            $return_arr['xacnhan'] .= $xacnhan_cnt . ',';
            $return_arr['thanhcong'] .= $thanhcong_cnt . ',';
            $return_arr['huy'] .= $huy_cnt . ',';
            $return_arr['danggiao'] .= $danggiao_cnt . ',';
            $return_arr['vnpost'] .= $vnpost_cnt . ',';

            $return_arr['date'] .= '"' . ($month) . '",';

        }

        $return_arr['dangcho'] = '[' . rtrim($return_arr['dangcho'], ',') . ']';
        $return_arr['xacnhan'] = '[' . rtrim($return_arr['xacnhan'], ',') . ']';
        $return_arr['thanhcong'] = '[' . rtrim($return_arr['thanhcong'], ',') . ']';
        $return_arr['huy'] = '[' . rtrim($return_arr['huy'], ',') . ']';
        $return_arr['danggiao'] = '[' . rtrim($return_arr['danggiao'], ',') . ']';
        $return_arr['vnpost'] = '[' . rtrim($return_arr['vnpost'], ',') . ']';

        $return_arr['date'] = '[' . rtrim($return_arr['date'], ',') . ']';

        return $return_arr;
    }

    public function chartincome($datefilter)
    {
        $tg = explode(" - ", $datefilter);

        $begin = new DateTime($tg[0]);
        $end = new DateTime($tg[1]);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);


        $return_arr = [];
        $return_arr['dangcho'] = '';
        $return_arr['xacnhan'] = '';
        $return_arr['thanhcong'] = '';
        $return_arr['huy'] = '';
        $return_arr['danggiao'] = '';
        $return_arr['vnpost'] = '';
        $return_arr['date'] = '';

        $dangcho = DB::table('donhang')
            ->where('trang_thai', '1')
            ->selectRaw('date(created_at) as day, sum(so_tien) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        $xacnhan = DB::table('donhang')
            ->where('trang_thai', '2')
            ->selectRaw('date(created_at) as day, sum(so_tien) as total')
            ->groupby('day')
            ->pluck('total', 'day');


        $huy = DB::table('donhang')
            ->where('trang_thai', '5')
            ->selectRaw('date(created_at) as day, sum(so_tien) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        $thanhcong = DB::table('donhang')
            ->where('trang_thai', '4')
            ->selectRaw('date(created_at) as day, sum(so_tien) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        $danggiao = DB::table('donhang')
            ->where('trang_thai', '3')
            ->selectRaw('date(created_at) as day, sum(so_tien) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        $vnpost = DB::table('donhang')
            ->where('trang_thai', '6')
            ->selectRaw('date(created_at) as day, sum(so_tien) as total')
            ->groupby('day')
            ->pluck('total', 'day');

        foreach ($daterange as $date) {
            $month = $date->format("Y-m-d");
            $dangcho_cnt = (isset($dangcho[$month]) ? $dangcho[$month] : 'null');
            $xacnhan_cnt = (isset($xacnhan[$month]) ? $xacnhan[$month] : 'null');
            $huy_cnt = (isset($huy[$month]) ? $huy[$month] : 'null');
            $thanhcong_cnt = (isset($thanhcong[$month]) ? $thanhcong[$month] : 'null');
            $danggiao_cnt = (isset($danggiao[$month]) ? $danggiao[$month] : 'null');
            $vnpost_cnt = (isset($vnpost[$month]) ? $vnpost[$month] : 'null');

            $return_arr['dangcho'] .= $dangcho_cnt . ',';
            $return_arr['xacnhan'] .= $xacnhan_cnt . ',';
            $return_arr['thanhcong'] .= $thanhcong_cnt . ',';
            $return_arr['huy'] .=  $huy_cnt. ',';
            $return_arr['danggiao'] .= $danggiao_cnt . ',';
            $return_arr['vnpost'] .= $vnpost_cnt . ',';

            $return_arr['date'] .= '"' . ($month) . '",';

        }

        $return_arr['dangcho'] = '[' . rtrim($return_arr['dangcho'], ',') . ']';
        $return_arr['xacnhan'] = '[' . rtrim($return_arr['xacnhan'], ',') . ']';
        $return_arr['thanhcong'] = '[' . rtrim($return_arr['thanhcong'], ',') . ']';
        $return_arr['huy'] = '[' . rtrim($return_arr['huy'], ',') . ']';
        $return_arr['danggiao'] = '[' . rtrim($return_arr['danggiao'], ',') . ']';
        $return_arr['vnpost'] = '[' . rtrim($return_arr['vnpost'], ',') . ']';

        $return_arr['date'] = '[' . rtrim($return_arr['date'], ',') . ']';

        return $return_arr;
    }

}
