<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseDetail extends Model
{
    protected $table = "warehouse_detail";
    protected $primaryKey = 'wareshouse_detail_id';
    protected $fillable = [ 'wareshouse_detail_id', 'warehouse_id', 'uid', 'product_id', 'product_name', 'product_model',
        'quantity', 'created_at', 'updated_at'
    ];


    static function wd_get_data_id_all()
    {
        $data = DB::table('warehouse_detail')->get();
        return $data;
    }
    static function wd_get_by_id($id)
    {
        $data = DB::table("warehouse_detail")->where('wareshouse_detail_id', $id)->get();
        return $data;
    }
}
