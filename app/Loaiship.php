<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Loaiship extends Model
{
    protected $table = 'loaiship';


    protected $fillable = ['idsp','loai_ship'];
}