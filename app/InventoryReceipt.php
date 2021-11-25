<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryReceipt extends Model
{
    protected $table = "inventory_receipt";
    protected $primaryKey='receipt_id';
    public $timestamp = true;

    protected $fillable = ['receipt_date','seller_id','total_qty','invoice_id'];

    static function receipt_get_data_id_all(){
        $data = DB::table('inventory_receipt')->get();
        return $data;

    }
}
