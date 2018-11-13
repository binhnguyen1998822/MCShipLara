<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Coso extends Model
{
    protected $table = 'coso';


    protected $fillable = ['idcs','ten_coso'];
	public $timestamps = false;
}