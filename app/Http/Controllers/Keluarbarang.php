<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Keluarbarang extends Model
{
    protected $table = "inventory_out";
    protected $primaryKey='out_id';
    protected $fillable = [	'uid','product_id', 'inventory_id', 'location_id','user_id','status','product_name', 'product_model', 'date_out', 'seller_id','receipt_id','order_id','creator'];


    static function get_data_id_all(){
        $data = DB::table('inventory_out')->get();
        return $data; 
       
    }
    static function detail_data_id_all(){
        $data = DB::table('inventory_out')->get();
        return $data;
        
    }
    static function proses_data_id_all(){
        $data = DB::table('inventory_out')->get();
        return $data;
        
    }
    static function keluar_data_id(){
        $data = DB::table('inventory_out')->get();
        return $data;

    }

    static function keluar_get_by_id($id){
        $data = DB::table("inventory_out")->where('out_id',$id)->get();
        return $data;
    }
    static function keluar_by_id($id){
        $data = DB::table("inventory_out")->where('out_id',$id)->get();
        return $data;
    }
    
    static function keluar_detail_by_id($id){
        $data = DB::table("inventory_out")->where('out_id',$id)->get();
        return $data;
    }

    static function keluar_delete($id){
    
        $delete  = DB::DELETE("DELETE FROM inventory_out where out_id ='".$id."' ");
        return $delete;
    }
    static function keluar_proses($Request){
        $out_id = $Request->get('foton');
        $array=array();
        foreach ($out_id as $key => $value) {
            $data = DB::table("inventory_out")->where('out_id',$value)->get();
            if($data){
                array_push($array,$data[0]);  
            }       
        }
        return $array;
    }
}
