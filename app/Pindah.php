<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pindah extends Model
{
    protected $table = "warehouse";
    protected $primaryKey = 'warehouse_id';
    protected $fillable = [ 'warehouse_id', 'warehouse_detail_id', 'warehouse_name', 'warehouse_code', 'warehouse_date', 'destination',
        'status', 'seller_id', 'notes', 'location', 'address_id', 'creator'
    ];


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
    // static function tbb_data_id()
    // {
    //     $data = DB::table('warehouse')->get();
    //     return $data;
    // }
}
