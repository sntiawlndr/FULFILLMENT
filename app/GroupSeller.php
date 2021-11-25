<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupSeller extends Model
{
    protected $table = "seller_group";
    protected $primaryKey='seller_group_id';
    public $timestamp = true;
    

    protected $fillable = ['group_name','price','status','created_at','updated_at'];



    static function get_data_id_all(){
        $data = DB::table('seller_group')->get();
        return $data;

    }
    static function get_data_id(){
        $data = DB::table('seller_group')->get();
        return $data;

    }
    static function group_get_by_id($id){
        $data = DB::table("seller_group")->where('seller_group_id',$id)->get();

        return $data;
}
}