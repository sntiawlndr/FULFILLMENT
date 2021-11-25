<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Barang extends Model
{
    protected $table = "fm_product";
    protected $primaryKey='product_id';
    protected $fillable = ['product_id','category_id','seller_id','location_id','product_name','product_model','user_id','product_sku','size','product_status'];


    static function get_data_id_all(){
        $data = DB::table('fm_product')->get();
        return $data;

    }
    static function get_data_id(){
        $data = DB::table('fm_product')->get();
        return $data;

    }
    static function get_data_id_d(){
        $data = DB::table('fm_product')->get();
        return $data;

    }

    static function barang_get_by_id($id){
        $data = DB::table("fm_product")->where('product_id',$id)->get();
        return $data;
    }

    static function detail_get_by_id($id){
        $data = DB::table("fm_product")->where('product_id',$id)->get();
        return $data;
    }
    
    static function barang_print_by_id($id){
        $data = DB::table("fm_product")->where('product_id',$id)->get();
        return $data;
    }

    static function barang_delete($id){
    
        $delete  = DB::DELETE("DELETE FROM fm_product where product_id ='".$id."' ");
        return $delete;
    }

    static function barang_get_by_user_id($user_id){
        $data = DB::table("fm_product")->where('user_id',$user_id)->get();
        return $data;
    }
}
