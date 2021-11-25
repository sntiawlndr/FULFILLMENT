<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class InvBorrowModel extends Model
{
    protected $table = 'inventory_borrow';
    protected $primaryKey = 'borrow_id';
    public $timestamp = true;
    protected $fillable = ['borrow_date','borrow_invoice_id','borrow_name','borrow_telepon','borrow_delivery','notes','address_id','seller_id','user_id','created_at','updated_at'];

    static function get_data_all(){
        $data=DB::table('inventory_borrow')->get();
        return $data;
    }
    static function category_get_by_id($id){
        $data = DB::table("inventory_borrow")->where('borrow_id',$id)->get();
        return $data;
    }
    static function category_delete_by_id($id){
        $delete = DB::DELETE("DELETE FROM inventory_borrow WHERE borrow_id ='".$id."' ");
        return $delete;
    }

    static function generatePinjamId($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}
