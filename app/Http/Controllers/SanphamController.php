<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sanpham;
use App\Khachhang;

class SanphamController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Sanpham::select("ten_sanpham as name")->where("ten_sanpham","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }
	
	public function autocompletephone(Request $request)
    {
        $data = Khachhang::select("phone as name")->where("phone","LIKE","%{$request->input('query')}%")->groupBy('phone')->get();
        return response()->json($data);
    }
	
	
}
