<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class CnCountryModel extends Model
{
    protected $table = "cn_country";
    protected $primaryKey = 'country_id';
    protected $fillable = ['name','iso_code_2','iso_code_3','address_format','postcode_required','status'];


    static function get_data_id_all()
    {
        $data = DB::table('cn_country')->get();
        return $data;
    }
    static function gudang_get_by_id($id)
    {
        $data = DB::table("cn_country")->where('country_id', $id)->get();
        return $data;
    }
}
