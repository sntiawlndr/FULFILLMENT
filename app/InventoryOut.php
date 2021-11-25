<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryOut extends Model
{
    protected $table = "inventory_out";
    protected $primaryKey='out_id';
    public $timestamp = true;

    protected $fillable = ['uid','product_id','product_name','product_model','date_out','receipt_id','order_id'];

    static function out_get_data_id_all(){
        $data = DB::table('inventory_out')->get();
        return $data;

    }
}
