<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class CitiesModel extends Model
{
    protected $table = "cities";
    protected $primaryKey = 'city_id';
    protected $fillable = ['city_name','prov_id'];


    static function get_data_id_all()
    {
        $data = DB::table('cities')->get();
        return $data;
    }
    static function city_get_by_id($id)
    {
        $data = DB::table("cities")->where('prov_id', $id)->get();
        return $data;
    }
}
