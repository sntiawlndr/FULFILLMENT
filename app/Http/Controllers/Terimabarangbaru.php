<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Terimabarangbaru extends Model
{
    protected $table = "fm_order";
    protected $primaryKey='order_id';
    protected $fillable = ['order_detail_id','seller_id','inventory_id','no_invoice','order_email','order_telpon','customer_name','order_status_id','status','creator','address_id','order_date','amount'];


    static function get_data_id_all(){
        $data = DB::table('fm_order')->get();
        return $data;

    }
    static function tbb_data_id(){
        $data = DB::table('fm_order')->get();
        return $data;

    }
    static function summary_data_id(){
        $data = DB::table('fm_order')->get();
        return $data;

    }

    static function tbb_get_by_id($id){
        $data = DB::table("fm_order")->where('order_id',$id)->get();
        return $data;
    }
    
    static function baru_print_by_id($id){
        $data = DB::table("fm_order")->where('order_id',$id)->get();
        return $data;
    }

    static function baru_delete($id){
    
        $delete  = DB::DELETE("DELETE FROM fm_order where order_id ='".$id."' ");
        return $delete;
    }
}
