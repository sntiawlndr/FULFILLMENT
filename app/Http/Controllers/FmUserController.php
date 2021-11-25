<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FmUser;
use App\Role;
use DB;
use Illuminate\Support\Facades\Hash;

class FmUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::get_data_id_all();
    
        // $data = ParentModel::category_get_by_id($category_id);
        return view('admin_user.user_add')->with('roles',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT group_name FROM fm_group_role WHERE group_role_id = fm_users.group_role) as group_name ";
        // $join .= "(SELECT seller_name FROM fm_seller WHERE seller_id = fm_users.seller_id) as seller_name ";

        if($search){  
            $filters = "";
            if(!empty($_POST['status'])){
    
                $filters = "fm_users.user_status ='".$_POST['status']."' && ";
                
               }  
    
   
        $query = "$filters (name LIKE '%$search%' OR email LIKE '%$search%') ";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_users WHERE $query )jumdata, $join FROM fm_users WHERE $query LIMIT $start,$length ");
   
    }else{
        $filters = "";
        if(!empty($_POST['status'])){

            $filters = "WHERE fm_users.user_status ='".$_POST['status']."'";
            
           }
    
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_users)jumdata, $join FROM fm_users  $filters LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_show()
    {
        
        $data = Role::get_data_id_all();
        return view('admin_user.user_show')->with('Roles',$data);
    }

    public function user_save(Request $request){

        $add = New FmUser;
        $add->user_id= $request->get('user_id'); 
        $add->name = $request->get('name'); 
        $add->email = $request->get('email'); 
        $add->user_telepon = $request->get('user_telepon');
        $pw = FmUser::generateRandomPassword() ;
        
        $add->password = Hash::make($pw) ;
        $add->group_role = $request->get('group_role'); 
        $add->user_status = $request->get('user_status');
        $result = $add->save();

        if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }

    

    public function user_edit($user_id){
        $data['users'] = FmUser:: user_get_by_id($user_id)[0];
        $data['roles2'] =  Role::get_data_id_all(); 
        $data['roles'] = Role::role_get_by_id($data['users']->group_role)[0];       
        return view('admin_user.user_edit')->with('data',$data);
    }

     public function user_update(Request $request){
        $add = FmUser::where('user_id',$request->get('user_id'))->firstOrFail();
        $add->name = $request->get('name'); 
        $add->email = $request->get('email'); 
        $add->user_telepon = $request->get('user_telepon'); 
        $add->group_role = $request->get('group_role');
        $add->user_status = $request->get('user_status');
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }



    public function user_delete($id){
        $delete = FmUser::user_delete_by_id($id);
        return redirect('/user');
    }


    public function user_get($id){

        $data = FmUser::user_get_by_id($id);
 return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}




}
