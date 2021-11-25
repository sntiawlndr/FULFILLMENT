<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Order_detail extends Model
{
    protected $table = "fm_order_detail";
    protected $primaryKey='order_detail_id';
    protected $fillable = [	'order_id','product_id','product_name', 'product_model','product_sku' ,'quantity','user_id','uid'];


    static function orderdetail_get_data_id_all(){
        $data = DB::table('fm_order_detail')->get();
        return $data;

    }
    static function orderdetail_get_by_id($id){
        $data = DB::table("fm_order_detail")->where('order_detail_id',$id)->get();
        return $data;
    }
    static function orderdetail_get_by_order_id($order_id){
        $data = DB::table("fm_order_detail")->where('order_id',$order_id)->get();
        return $data;
    }
    static function generateRandomUID($length = 12) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
