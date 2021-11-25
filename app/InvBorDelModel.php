<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class InvBorDelModel extends Model
{
    protected $table = 'inventory_borrow_detail';
    protected $primaryKey = 'borrow_detail';
    public $timestamp = true;
    protected $fillable = ['borrow_id','product_id','product_name','product_sku','product_model','quantity','created_at','updated_at'];

    static function get_data_all(){
        $data=DB::table('inventory_borrow_detail')->get();
        return $data;
    }
}
