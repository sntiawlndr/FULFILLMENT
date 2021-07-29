<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Terimabaranglama extends Model
{
    protected $table = "inventory_data";
    protected $primaryKey='inventory_id';
    protected $fillable = ['product_id','order_id','seller_id','amount'];


    static function get_data_id_all(){
        $data = DB::table('inventory_data')->get();
        return $data;

    }
    static function tbl_data_id(){
        $data = DB::table('inventory_data')->get();
        return $data;

    }

    static function edit_get_by_id($id){
        $data = DB::table("inventory_data")->where('inventory_id',$id)->get();
        return $data;
    }
    
    static function barang_print_by_id($id){
        $data = DB::table("inventory_data")->where('inventory_id',$id)->get();
        return $data;
    }

    static function barang_delete($id){
    
        $delete  = DB::DELETE("DELETE FROM inventory_data where inventory_id ='".$id."' ");
        return $delete;
    }
}
