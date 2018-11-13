<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Shipper extends Model
{
    protected $table = 'shipper';


    protected $fillable = ['sp_name','sp_email','sp_password','sp_online'];
	public $timestamps = false;
	
		

	
}