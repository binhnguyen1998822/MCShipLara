<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Hoahong extends Model
{
    protected $table = 'hoahong';


    protected $fillable = ['hh_bhv','hh_mayban','hh_phukien'];
	public $timestamps = false;
}