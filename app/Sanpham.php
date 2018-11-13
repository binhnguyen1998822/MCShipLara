<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Sanpham extends Model
{
    protected $table = 'sanpham';


    protected $fillable = ['ten_sanpham'];
	public $timestamps = false;
}