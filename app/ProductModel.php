<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductModel extends Model
{
    protected $table = "product";
    protected $primaryKey='product_id';
    protected $fillable = ['product_name','description'];


    static function get_data_id_all(){
        $data = DB::table('product')->get();
        return $data;

    }

    static function product_get_by_id($id){
        $data = DB::table("product")->where('product_id',$id)->get();
        return $data;
    }

    static function product_delete($id){
    
        $delete  = DB::DELETE("DELETE FROM product where product_id ='".$id."' ");
        return $delete;
    }
}
