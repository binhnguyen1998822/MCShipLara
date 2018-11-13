<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Bank extends Model
{
    protected $table = 'nganhang';


    protected $fillable = ['idb','ten_nganhang'];
	public $timestamps = false;
}