<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Order_detail extends Model
{
    protected $table = "order_detail";
    protected $primaryKey='order_detail_id';
    protected $fillable = [	'order_id','product_id','product_name', 'product_model' ,'quantity'];


    static function orderdetail_get_data_id_all(){
        $data = DB::table('order_detail')->get();
        return $data;

    }
    static function orderdetail_get_by_id($id){
        $data = DB::table("order_detail")->where('order_detail_id',$id)->get();
        return $data;
    }
}
