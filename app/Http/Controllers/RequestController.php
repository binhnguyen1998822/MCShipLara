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

use Illuminate\Support\Facades\Session;

class RequestController extends Controller 
{

	 //adduser
	     public function update()
    {
			 DB::table('donhang')
                ->where('id_shipper', $_POST['id_shipper'])
                ->update($_POST);
       echo json_encode(array("status" => "success"));
    }

	
}
