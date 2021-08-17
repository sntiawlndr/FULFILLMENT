<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModuleModel;


class ModuleController extends Controller
{
    function select2_get_raw(Request $request){
         try {

          /*  $search = $request->get('q');
            if(empty($request->get('q'))){
              $search = 'xnullx';
            }*/
            
            $output = ModuleModel::select2_get_raw($request);

            echo json_encode($output);
        } catch (Exception $e) {
            echo json_encode(array('msg'=>'gagal', 'content'=>$e->getMessage(), 'success'=>FALSE, 'token_status'=>'invalid'));          
        }

    }

    function select2_get_like(){

      try {

            $output = ModuleModel::select2_group_get_like($_GET['query']);

            echo json_encode($output);
        } catch (Exception $e) {
            echo json_encode(array('msg'=>'gagal', 'content'=>$e->getMessage(), 'success'=>FALSE, 'token_status'=>'invalid'));          
        }

    }

}
