<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;

class Gudang extends Model
{
    protected $table = "warehouse_location";
    protected $primaryKey = 'location_id';
    protected $fillable = ['location_id', 'address_id', 'location_name', 'location_code','creator','location_status','address_id','warehouse_status'];


    static function get_data_id_all()
    {
        $data = DB::table('warehouse_location')->get();
        return $data;
    }
    static function gudang_get_by_id($id)
    {
        $data = DB::table("warehouse_location")->where('location_id', $id)->get();
        return $data;
    }

    static function gudang_delete($id)
    {

        $delete  = DB::DELETE("DELETE FROM warehouse_location where location_id ='" . $id . "' ");
        return $delete;
    }
}
