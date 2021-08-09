<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Location extends Model
{
    protected $table = "warehouse_location";
    protected $primaryKey='location_id';
    protected $fillable = [	'location_name','creator','location_status'];


    static function location_get_data_id_all(){
        $data = DB::table('warehouse_location')->get();
        return $data;

    }
    static function location_get_by_id($id){
        $data = DB::table("warehouse_location")->where('location_id',$id)->get();
        return $data;
    }
}
