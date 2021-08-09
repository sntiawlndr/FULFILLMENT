<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Detail extends Model
{
    protected $table = "warehouse_detail";
    protected $primaryKey = 'warehouse_detail_id';
    protected $fillable = ['warehouse_detail_id', 'warehouse_id', 'uid', 'product_id', 'product_name', 'product_model', 'quantity', 'warehouse_code'];


    static function pindah_get_data_id_all()
    {
        $data = DB::table('warehouse_detail')->get();
        return $data;
    }
    static function pindah_get_by_id($id)
    {
        $data = DB::table("warehouse_detail")->where('warehouse_detail_id', $id)->get();
        return $data;
    }
}
