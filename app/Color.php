<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Color extends Model
{
    protected $table = 'color';


    protected $fillable = ['id_cl','ten_color'];
	public $timestamps = false;
}