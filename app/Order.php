<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $table = "fm_order";
    protected $primaryKey='order_id';
    protected $fillable = ['order_id','no_invoice','order_email','order_telpon','customer_name','order_status_id','creator','address_id','order_date','status','amount','order_status'];


    static function order_get_data_id_all(){
        $data = DB::table('fm_order')->get();
        return $data;

    }

    static function detail_data_id(){
        $data = DB::table('fm_order')->get();
        return $data;

    }

    static function order_get_by_id($id){
        $data = DB::table("fm_order")->where('order_id',$id)->get();
        return $data;
    }
    static function bayar_data_id(){
        $data = DB::table('fm_order')->get();
        return $data;

    }
    static function invbor_get_by_userid($user_id){
        $data = DB::table("fm_order")->where('user_id',$user_id)->get();
        return $data;
    }

    static function order_by_order_id($order_id){
        $data = DB::table("fm_order")->where('order_id',$order_id)->get();
        return $data;
    }

}
