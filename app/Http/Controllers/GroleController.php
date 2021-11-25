<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use DB;

class GroleController extends Controller
{
    function index(){
        $data = Role::get_data_id_all();
    
        // $data = ParentModel::category_get_by_id($category_id);
        return view('group_role.grole_add')->with('roles',$data);
        
        
    }


    public function grole_save(Request $request){

        $add = New Role;
        $add->group_role_id = $request->get('group_role_id');
        $add->group_name = $request->get('group_name'); 
        $add->group_status = $request->get('group_status');
        $result = $add->save();

        if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }

    public function grole_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
   
       
       if($search){   
           $filters = "";
           if(!empty($_POST['group_status'])){
   
               $filters = "fm_group_role.group_status ='".$_POST['group_status']."' && ";
               
              }
   
        $query = "$filters (group_name LIKE '%$search%' OR group_status LIKE '%$search%') ";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_group_role WHERE $query )jumdata FROM fm_group_role WHERE $query LIMIT $start,$length ");
   
       }else{
           $filters = "";
           if(!empty($_POST['group_status'])){
   
               $filters = "WHERE fm_group_role.group_status ='".$_POST['group_status']."'";
               
              }
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_group_role)jumdata FROM fm_group_role $filters LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }

    public function grole_show(){

        $data = Role::get_data_id_all();
        return view('group_role.grole_show')->with('data',$data);
    }

    public function grole_edit($group_role_id){
        $roles = Role::get_data_id_all();
        $data = Role::role_get_by_id($group_role_id);
        
        return view('group_role.grole_edit')->with('grole',$data[0])->with('roles',$roles);
    }

     public function grole_update(Request $request){

        $add = Role::where('group_role_id',$request->get('group_role_id'))->firstOrFail();
        $add->group_role_id = $request->get('group_role_id');  
        $add->group_name = $request->get('group_name'); 
        $add->group_status = $request->get('group_status');
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }



    public function grole_delete($id){
        $delete = Role::role_delete_by_id($id);
        return redirect('/grole');
    }

    public function grole_suspend($id){
        $add = Role::where('group_role_id',$id)->firstOrFail();
        $add->group_status = 'disable';
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
    }
    public function grole_unsuspend($id){
        $add = Role::where('group_role_id',$id)->firstOrFail();
        $add->group_status = 'enable';
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
    }


    public function grole_get($id){

        $data = Role::role_get_by_id($id);
 return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));


    }
}
