<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class CnZoneModel extends Model
{
    protected $table = "cn_zone";
    protected $primaryKey = 'zone_id';
    protected $fillable = ['country_id', 'name','kota','code','ninja_code','jnt_code','status'];


    static function get_data_id_all()
    {
        $data = DB::table('cn_zone')->get();
        return $data;
    }
    static function gudang_get_by_id($id)
    {
        $data = DB::table("cn_zone")->where('zone_id', $id)->get();
        return $data;
    }
}
