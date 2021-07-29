<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class CategoryModel extends Model
{
    protected $table = 'fm_category';
    protected $primaryKey = 'category_id';
    public $timestamp = true;
    protected $fillable = ['category_name','category_status','category_parent_id','created_at','updated_at'];

    static function get_data_id_all(){
        $data=DB::table('fm_category')->get();
        return $data;
    }
    static function category_get_by_id($id){
        $data = DB::table("fm_category")->where('category_id',$id)->get();
        return $data;
    }
    static function category_delete_by_id($id){
        $delete = DB::DELETE("DELETE FROM fm_category WHERE category_id ='".$id."' ");
        return $delete;
    }
}
