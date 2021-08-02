<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Address extends Model
{
    protected $table = "fm_address";
    protected $primaryKey ='address_id';
    protected $fillable = ['seller_id','address','address_telpon','address_city','address_district','country_id'];


    static function get_data_id_all(){
        $data = DB::table('fm_address')->get();
        return $data;

    }
    static function address_get_by_id($id){
        $data = DB::table("fm_address")->where('address_id',$id)->get();
        return $data;
    }
}
