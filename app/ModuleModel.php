<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModuleModel extends Model
{
    static function select2_get_raw($post){
        
        
        if(empty($post['q'])){
            if(!empty($post['clausefield'])){
                 $data = DB::table($post['field'])
                 ->select("".$post['id']." as id","".$post['name']." as text")
                 ->where("".$post['clausefield']."", '=',$post['clausevalue'])
                 ->groupby($post['id'])
                ->get();

            }else{
            $data = DB::table($post['field'])
                 ->select("".$post['id']." as id","".$post['name']." as text")
            	->limit(10)
                ->get();
            }
        }else{
            if(!empty($post['clausefield'])){
                $data = DB::table($post['field'])
                ->select("".$post['id']." as id","".$post['name']." as text")
                 ->where("".$post['clausefield']."", '=',$post['clausevalue'])
                ->where("".$post['name']."", 'LIKE', '%'.$post['q'].'%')
                
                ->get();
            }else{
         $data = DB::table($post['field'])
                ->select("".$post['id']." as id","".$post['name']." as text")
                ->where("".$post['name']."", 'LIKE', '%'.$post['q'].'%')
                ->limit(10)
                ->get();
            }
        }
        return $data;
    }

    static function select2_group_get_like($query){


         $data = DB::table("shift")
                ->where('name', 'LIKE', '%'.$query.'%')
                ->limit(10)
                ->get();
        
        return $data;

    }
}






