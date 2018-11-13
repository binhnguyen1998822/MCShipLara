<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Khachhang extends Model
{
    protected $table = 'khachhang';
    protected $fillable = ['phone','ghichu'];

}