<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Receipt extends Model
{
   protected $table = "inventory_receipt";
    protected $primaryKey ='receipt_id';
    protected $fillable = [ 'receipt_date','seller_id','total_qty','invoice_id','creator'];


    static function get_data_id_all()
    {
        $data = DB::table('inventory_receipt')->get();
        return $data;
    }
    static function receipt_get_by_id($id)
    {

        $data = DB::table("inventory_receipt")->where('receipt_id', $id)->get();
        return $data;
    }
    // static function get_data_id()
    // {
    //     $data = DB::table('fm_address')->get();
    //     return $data;
    // }
    // static function seller_delete($id)
    // {

    //     $delete  = DB::DELETE("DELETE FROM fm_address where address_id ='" . $id . "' ");
    //     return $delete;
    // }
}