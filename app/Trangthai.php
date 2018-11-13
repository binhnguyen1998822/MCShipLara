<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Trangthai extends Model
{
    protected $table = 'trangthai';


    protected $fillable = ['idtt','ten_trangthai'];
}