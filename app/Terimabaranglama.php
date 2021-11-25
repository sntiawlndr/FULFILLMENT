<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Terimabaranglama extends Model
{
    protected $table = "fm_order";
    protected $primaryKey='order_id';
    protected $fillable = ['no_invoice','order_email','order_delivery','type','order_telpon','user_id','customer_name','order_status_id','creator','user_id','address_id','order_date','amount','order_status_id'];


    static function get_data_id_all(){
        $data = DB::table('fm_order')->get();
        return $data;

    }
    static function tbl_data_id(){
        $data = DB::table('fm_order')->get();
        return $data;

    }

    static function edit_get_by_id($id){
        $data = DB::table("fm_order")->where('order_id',$id)->get();
        return $data;
    }
    
    static function barang_print_by_id($id){
        $data = DB::table("fm_order")->where('order_id',$id)->get();
        return $data;
    }

    static function barang_delete($id){
    
        $delete  = DB::DELETE("DELETE FROM fm_order where order_id ='".$id."' ");
        return $delete;
    }
}
