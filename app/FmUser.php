<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class FmUser extends Model
{
    protected $table = "fm_users";
    protected $primaryKey='user_id';
    protected $fillable = ['name', 'email', 'password',];
    //
    protected $hidden = [
        'password', 'remember_token',
    ];
    //
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
