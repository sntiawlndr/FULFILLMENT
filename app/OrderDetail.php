<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderDetail extends Model
{
    protected $table = "fm_order_detail";
    protected $primaryKey='order_detail_id';
    public $timestamp = true;

    protected $fillable = ['order_id','product_id','product_name','product_model','quantity'];

    static function order_detail_get_data_id_all(){
        $data = DB::table('fm_order_detail')->get();
        return $data;

    }
    static function get_data_id_detail(){
        $data = DB::table('fm_order_detail')->get();
        return $data;

    }
}
