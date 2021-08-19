<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    protected $table = "fm_address";
    protected $primaryKey = 'address_id';
    protected $fillable = ['seller_id', 'address', 'address_telepon', 'address_city', 'address_districts', 'country_id','address_postal_code'];


    static function get_data_id_all()
    {
        $data = DB::table('fm_address')->get();
        return $data;
    }
    static function address_get_by_id($id)
    {

        $data = DB::table("fm_address")->where('address_id', $id)->get();
        return $data;
    }
    static function get_data_id()
    {
        $data = DB::table('fm_address')->get();
        return $data;
    }
    static function seller_delete($id)
    {

        $delete  = DB::DELETE("DELETE FROM fm_address where address_id ='" . $id . "' ");
        return $delete;
    }
}
