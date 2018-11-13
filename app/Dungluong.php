<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Dungluong extends Model
{
    protected $table = 'dungluong';


    protected $fillable = ['id_dl','so_dungluong'];
	public $timestamps = false;
}