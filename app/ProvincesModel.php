<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class ProvincesModel extends Model
{
    protected $table = "provinces";
    protected $primaryKey = 'prov_id';
    protected $fillable = ['prov_name','locationid','status'];


    static function get_data_id_all()
    {
        $data = DB::table('provinces')->get();
        return $data;
    }
    static function provinces_get_by_id($id)
    {
        $data = DB::table("provinces")->where('prov_id', $id)->get();
        return $data;
    }
}
