<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class FmUser extends Model
{
    protected $table = "fm_users";
    protected $primaryKey='user_id';
    protected $fillable = ['name', 'email', 'password','user_telepon'];
    //
    protected $hidden = [
        'password', 'remember_token',
    ];
    //
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //
    static function get_data_id_all(){
        $data=DB::table('fm_users')->get();
        return $data;
    }
    static function user_get_by_id($id){
        $data = DB::table("fm_users")->where('user_id',$id)->get();
        return $data;
    }
    static function user_delete_by_id($id){
        $delete = DB::DELETE("DELETE FROM fm_users WHERE user_id ='".$id."' ");
        return $delete;
    }

    static function generateRandomPassword($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
