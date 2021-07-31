<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pindah extends Model
{
    protected $table = "warehouse";
    protected $primaryKey = 'warehouse_id';
    protected $fillable = ['warehouse_id', 'address_id', 'warehouse_name', 'warehouse_code'];


    static function pindah_get_data_id_all()
    {
        $data = DB::table('warehouse')->get();
        return $data;
    }
    static function pindah_get_by_id($id)
    {
        $data = DB::table("warehouse")->where('warehouse_id', $id)->get();
        return $data;
    }

    static function pindah_delete($id)
    {

        $delete  = DB::DELETE("DELETE FROM warehouse where warehouse_id ='" . $id . "' ");
        return $delete;
    }
}
