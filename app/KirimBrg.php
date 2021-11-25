<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KirimBrg extends Model
{
    protected $table = "fm_kirim_barang";
    protected $primaryKey='order_id';
    protected $fillable = ['no_invoice','order_email','order_telpon','user_id','customer_name','order_status_id','status','user_id','creator','address_id','id_pengiriman','notes','position','order_date','amount','order_status'];

    static function get_data_id_all(){
        $data = DB::table('fm_kirim_barang')->get();
        return $data;

    }
    static function tbb_data_id(){
        $data = DB::table('fm_kirim_barang')->get();
        return $data;

    }
    static function summary_data_id(){
        $data = DB::table('fm_kirim_barang')->get();
        return $data;

    }

    static function tbb_get_by_id($id){
        $data = DB::table("fm_kirim_barang")->where('order_id',$id)->get();
        return $data;
    }
    
    
    static function baru_print_by_id($id){
        $data = DB::table("fm_kirim_barang")->where('order_id',$id)->get();
        return $data;
    }

    static function bttn_btl($id){
    
        $delete  = DB::DELETE("DELETE FROM fm_kirim_barang_detail where uid ='".$id."' ");
        return $delete;
    }

    static function bttn_scan($id){
        $data = DB::table("fm_kirim_barang_detail")->where('uid',$id)->first();
        return $data;
    }
    

    // public detail(){
    //     $this->hasOne(KirimBrgDtl::class, '')
    // }
}