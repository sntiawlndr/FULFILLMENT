<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Terimabaranglama extends Model
{
    protected $table = "inventory_borrow";
    protected $primaryKey='borrow_id';
    protected $fillable = ['borrow_date','borrow_detail','uid','borrow_invoice_id','borrow_name'
    ,'borrow_telepon','borrow_delivery'	,'address_id','seller_id'];


    static function get_data_id_all(){
        $data = DB::table('inventory_borrow')->get();
        return $data;

    }
    static function tbl_data_id(){
        $data = DB::table('inventory_borrow')->get();
        return $data;

    }

    static function edit_get_by_id($id){
        $data = DB::table("inventory_borrow")->where('borrow_id',$id)->get();
        return $data;
    }
    
    static function barang_print_by_id($id){
        $data = DB::table("inventory_borrow")->where('borrow_id',$id)->get();
        return $data;
    }

    static function barang_delete($id){
    
        $delete  = DB::DELETE("DELETE FROM inventory_borrow where borrow_id ='".$id."' ");
        return $delete;
    }
}
