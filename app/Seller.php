<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Seller extends Model
{
    protected $table = "fm_seller";
    protected $primaryKey='seller_id';
    protected $fillable = ['seller_email','seller_name','seller_telpon','group_role'];


    static function get_data_id_all(){
        $data = DB::table('fm_seller')->get();
        return $data;

    }
    static function seller_get_by_id($id){
        $data = DB::table("fm_seller")->where('seller_id',$id)->get();
        return $data;
    }
}
