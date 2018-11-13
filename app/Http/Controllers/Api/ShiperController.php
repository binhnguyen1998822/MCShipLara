<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\DonhangGallery;
use App\Notifications\ShipNoti;
use Notification;
use App\User;
use App\Shipper;
use App\Khachhang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ShiperController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function create()
    {

    }

	
	public function donhangfitter(Request $request)
    {
		$datefilter = $request->input('datefitter');
		
			
			$tg=explode(" - ", $datefilter);
			$donhang = DonhangGallery::orderBy('id', 'desc')->where('id_loaiship','3')->where('id_shipper',$request->input('id_shipper'))->whereBetween('created_at',$tg)->get();
			return $donhang;
			
    }

	
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$idshiper=$request->input('id_shipper');
		
		if($idshiper == null){
			return 'error';
		}else{
			$donhang = DonhangGallery::find($request->input('id'));
			$donhang->id_shipper= $idshiper;
			$donhang->trang_thai= $request->input('trang_thai');
			$donhang->save();
			$user =User::get();
			Notification::send($user, new ShipNoti($donhang));
			return $donhang;
		}
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		
      $shiper = Shipper::where('sp_email', $request->input('email'))->where('sp_password', $request->input('password'))->first();
	 
	  return $shiper;
    }

	
	public function donhangship(Request $request)
    {
		 $shipper= $request->input('id_shipper');
		 $datefilter = $request->input('time');
		 $tg=explode(" - ", $datefilter);
		 $donhang = DonhangGallery::select('id_shipper',DB::raw('COUNT(id_shipper) as sodon'))->where('trang_thai','4')->where('id_shipper',$shipper)->groupBy('id_shipper')->whereBetween('created_at',$tg)->first();
		  return $donhang;
    }
	
	
	public function isonline(Request $request)
    {
		if($request->input('sp_online') ==1){
			$shiper = DB::table('shipper')
            ->where('id_sp', $request->input('id_shiper'))
            ->update(['sp_online' => 1]);
			return 'online' ;
		}
		else{
			$shiper = DB::table('shipper')
            ->where('id_sp', $request->input('id_shiper'))
		->update(['sp_online' => 0]);
		return 'offline' ;
		}
	  
    }
	public function doimatkhau(Request $request)
    {
		if($request->input('newpassword') == null || $request->input('id_shipper')  == null || $request->input('password') == null ){
			return 'error';
		}else{
			$shiper = DB::table('shipper')
					->where('id_sp', $request->input('id_shipper'))->where('sp_password', $request->input('password'))
					->update(['sp_password' => $request->input('newpassword')]);
					return $shiper; ;
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function enull()
    {
        return view('error.404');
    }
	
	

	public function cuocgoi(Request $request)
    {		
      $cuocgoi = new Khachhang ();
	  $cuocgoi->phone =  $request->input('phone');
	  $cuocgoi->save();
	  return $cuocgoi;
    }   

}
