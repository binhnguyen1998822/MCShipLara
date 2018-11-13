<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['id','id_hd','id_loaiship','id_nganhang','id_shipper','ho_ten','so_dt','dia_chi','ten_may','sp_color','imei','id_bh','sp_dungluong','ram','so_tien','co_so','trang_thai','ghi_chu','phukien','id_user','ten_user','nhom'];
	
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
    public function bank()
    {
        return $this->belongsTo('App\Bank','id_nganhang','idb');
    }
	
    public function loaiship()
    {
        return $this->belongsTo('App\Loaiship','id_loaiship','idsp');
    }
    public function trangthai()
    {
        return $this->belongsTo('App\Trangthai','trang_thai','idtt');
    }
    public function shipper()
    {
        return $this->belongsTo('App\Shipper','id_shipper','id_sp');
    }
	    public function baohanh()
    {
        return $this->belongsTo('App\LoaiBH','id_bh','idbh');
    }
	
	
}