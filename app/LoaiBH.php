<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class LoaiBH extends Model
{
    protected $table = 'loaibaohanh';


    protected $fillable = ['idbh','loai_bh'];
}