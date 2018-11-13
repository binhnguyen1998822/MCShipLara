<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class MyIP extends Model
{
    protected $table = 'checkip';

    protected $fillable = ['myip'];
	public $timestamps = false;
}