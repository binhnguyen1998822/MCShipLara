<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\DonhangGallery;
use App\User;
use App\Bank;
use App\Shipper;
use App\Color;
use App\Coso;
use App\Hoahong;

use Illuminate\Support\Facades\Session;

class AdminController extends Controller 
{

	 //adduser
	     public function adduser()
    {
		$adduser = User::get();
        return view('admin.adduser',compact('adduser'));
    }
	 //deleteuser
	     public function deluser($id)
    {
		User::find($id)->delete();
    	return back()
    		->with('success','Xóa tài khoản thành công.');	
    }
	
	 //addbank
	     public function addbank()
    {
		$bank = Bank::get();
        return view('admin.addbank',compact('bank')); 
    }
	 //delbank
	     public function delbank($idb)
    {
		DB::delete('delete from nganhang where idb = ?',[$idb]);
	
        return back()
    		->with('success','Xóa ngân hàng thành công.');	
    }
	
	    public function addpbank(Request $request)
    {
		
		$bank['ten_nganhang'] = $request->ten_nganhang;
        Bank::create($bank);
        return back()->with('success','Thêm thành công.'); 
    }	
	 //color
	     public function color()
    {
		$color = Color::get();
        return view('admin.addcolor',compact('color')); 
    }
	 //delcolor
	     public function delcolor($id_cl)
    {
		DB::delete('delete from color where id_cl = ?',[$id_cl]);
	
        return back()
    		->with('success','Xóa màu thành công.');	
    }
	//thêm color
	    public function addpcolor(Request $request)
    {
		
		$color['ten_color'] = $request->ten_color;
        Color::create($color);
        return back()->with('success','Thêm thành công.'); 
    }	
	
	//coso
	     public function coso()
    {
		$coso = Coso::get();
        return view('admin.addcoso',compact('coso')); 
    }
	 //delcoso
	     public function delcoso($idcs)
    {
		DB::delete('delete from coso where idcs = ?',[$idcs]);
	
        return back()
    		->with('success','Xóa cơ sở thành công.');	
    }
	//thêm coso
	    public function addpcoso(Request $request)
    {
		
		$coso['ten_coso'] = $request->ten_coso;
        Coso::create($coso);
        return back()->with('success','Thêm thành công.'); 
    }	
	
	
	 //addship
	     public function addship()
    {
		$shipper = Shipper::get();
        return view('admin.addship',compact('shipper'));  
    }
		 //delshipper
	     public function delshipper($id_sp)
    {
		DB::delete('delete from shipper where id_sp = ?',[$id_sp]);
	
        return back()
    		->with('success','Xóa shipper thành công.');	
    }
		    public function addpship(Request $request)
    {
		 $this->validate($request, [
        'sp_email' => 'required|unique:shipper|max:255',
		]);
		$shipper['sp_name'] = $request->sp_name;
		$shipper['sp_email'] = $request->sp_email;
		$shipper['sp_online'] = $request->sp_online;
		$shipper['sp_password'] = $request->sp_password;		
		
        Shipper::create($shipper);
        return back()->with('success','Thêm người giao hàng thành công.'); 
    }

	     public function hoahong()
    {
		$hoahong = Hoahong::get();
        return view('admin.addhoahong',compact('hoahong')); 
    }	
	public function savehoahong(Request $request) {
		
        $hoahong=Hoahong::find(1);
		if($request->hh_bhv ==! null){
        $hoahong->hh_bhv = $request->hh_bhv;
		}
		if($request->hh_mayban ==! null){
        $hoahong->hh_mayban = $request->hh_mayban;
		}
		if($request->hh_phukien ==! null){
        $hoahong->hh_phukien = $request->hh_phukien;
		}
		      
        $hoahong->save();

        return back();

    }
}
