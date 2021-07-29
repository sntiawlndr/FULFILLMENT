<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    protected $table = "fm_group_role";
    protected $primaryKey='group_role_id';

    protected $fillable = ['group_role_id','group_name','group_status'];



    static function get_data_id_all(){
        $data = DB::table('fm_group_role')->get();
        return $data;

    }
    static function role_get_by_id($id){
        $data = DB::table("fm_group_role")->where('group_role_id',$id)->get();
        return $data;


    }
}
