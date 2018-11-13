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

class HistoryController extends Controller
{
    public function history(Request $request)
    {
		$lsdh = $request->lsdh;
		$history = History::where('id_hd',"$lsdh")->get();
		 return view('history',compact('history'));
		
    }


}
