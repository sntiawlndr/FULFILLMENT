<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Kartu extends Model
{
    protected $table = "inventory_data";
    protected $primaryKey = 'inventory_id';
    protected $fillable = ['product_id','product_name','uid','product_model','seller_id','inventory_status','receipt_id',
'order_id','order_detail_id','creator','receipt_detail'];


    static function get_data_id_all()
    {
        $data = DB::table('inventory_data')->get();
        return $data;
    }

    
    static function kartu_get_by_id($id)
    {
        $data = DB::table("inventory_data")->where('inventory_id', $id)->get();
        return $data;
    }

    static function gudang_delete($id)
    {

        $delete  = DB::DELETE("DELETE FROM warehouse_location where location_id ='" . $id . "' ");
        return $delete;
    }
}
