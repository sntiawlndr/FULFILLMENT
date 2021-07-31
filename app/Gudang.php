<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;

class Gudang extends Model
{
    protected $table = "warehouse";
    protected $primaryKey = 'warehouse_id';
    protected $fillable = ['warehouse_id', 'address_id', 'address_telepon', 'address', 'warehouse_name', 'warehouse_code'];


    static function get_data_id_all()
    {
        $data = DB::table('warehouse')->get();
        return $data;
    }
    static function gudang_get_by_id($id)
    {
        $data = DB::table("warehouse")->where('warehouse_id', $id)->get();
        return $data;
    }

    static function gudang_delete($id)
    {

        $delete  = DB::DELETE("DELETE FROM warehouse where warehouse_id ='" . $id . "' ");
        return $delete;
    }
}
