<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KirimBrgDtl extends Model
{
    protected $table = "fm_kirim_barang_detail";
    protected $primaryKey='order_detail_id';
    protected $fillable = ['order_id','product_id','product_name','uid','product_model','product_sku','quantity','created_at','user_id','updated_at'];
       
        

    static function krmdtl_get_data_id_all(){
        $data = DB::table('fm_kirim_barang_detail')->get();
        return $data;

    }

    static function krmdtl_data_id(){
        $data = DB::table('fm_kirim_barang_detail')->get();
        return $data;

    }

    static function krmdtl_get_by_id($id){
        $data = DB::table("fm_kirim_barang_detail")->where('order_detail_id',$id)->get();
        return $data;
    }
   
    static function krmdtl_get_by_userid($user_id){
        $data = DB::table("fm_kirim_barang_detail")->where('order_detail_id',$user_id)->get();
        return $data;
    }
    

    static function krmdtl_by_order_id($order_id){
        $data = DB::table("fm_kirim_barang_detail")->where('order_detail_id',$order_id)->get();
        return $data;
    }
    static function detail_get_by_product_id($product_id){
        $data = DB::table("fm_kirim_barang_detail")->where('product_id',$product_id)->get();
        return $data;
    }

}
