<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class ReceiptDetail extends Model
{
    protected $table = "inventory_receipt_detail";
    protected $primaryKey ='receipt_detail';
    protected $fillable = [ 'product_id','product_name','product_model','request_qty','receipt_qty','order_id'];


    static function get_data_id_all()
    {
        $data = DB::table('inventory_receipt_detail')->get();
        return $data;
    }
    static function get_data_id()
    {
        $data = DB::table('inventory_receipt_detail')->get();
        return $data;
    }
    // static function seller_delete($id)
    // {

    //     $delete  = DB::DELETE("DELETE FROM fm_address where address_id ='" . $id . "' ");
    //     return $delete;
    // }
}