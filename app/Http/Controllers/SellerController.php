<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Seller;
use App\Role;
use DB;

class SellerController extends Controller
{
    function index(){
        $data = Role::get_data_id_all();
        return view('seller.seller_add')->with('roles',$data);;
        // $data = Seller::get_data_id_all();
        // return view('admin_barang.barang_add')->with('sellers',$data);
    }


    public function seller_save(Request $request){
        

        $add = New Seller;
        $add->seller_email = $request->get('seller_email'); 
        $add->seller_telpon = $request->get('seller_telpon'); 
        $add->seller_name = $request->get('seller_name'); 
        $add->group_role = $request->get('group_role'); 
        // $pw = Seller::generateRandomString();
        // $add->password = Hash:make($pw);
        $result = $add->save();

        if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }

    public function seller_datatable(){

     $data=[];
     $length = $_POST['length'];
     $start = $_POST['start'];
     $search = $_POST['search']['value'];
     $join = "(SELECT address_city FROM fm_address WHERE address_id = fm_address.address_id) as address_name, ";
     $join .= "(SELECT group_name FROM fm_group_role WHERE group_role_id = fm_group_role.group_role_id) as group_name "; 

    
    if($search){   

     $query = "seller_email LIKE '%$search%' OR seller_telpon LIKE '%$search%' OR seller_name LIKE '%$search%' OR group_role LIKE '%$search%'";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_seller WHERE $query )jumdata FROM fm_seller WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_seller)jumdata FROM fm_seller LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }

    public function seller_show(){

        $data = Seller::get_data_id_all();
        return view('seller.seller_show')->with('data',$data);
    }

    public function seller_edit($seller_id){
        $data = Seller::seller_get_by_id($seller_id);

        return view('seller.seller_edit')->with('seller',$data[0]);
    }

     public function seller_update(Request $request){

        $add = Seller::where('seller_id',$request->get('seller_id'))->firstOrFail();
        $add->seller_email = $request->get('seller_email'); 
        $add->seller_telpon = $request->get('seller_telpon'); 
        $add->seller_name = $request->get('seller_name'); 
        $add->group_role = $request->get('group_role'); 
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }



    public function seller_delete($id){
        $delete = Seller::seller_delete($id);
        return redirect('/seller');
    }
    public function ganti_show(){
        
        $data = Seller::ganti_data_id();      
        return view('seller.ganti_password')->with('data',$data[0]);
    }


    public function seller_get($id){

        $data = Seller::seller_get_by_id($id);
    return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));

    }
    // // static function generateRandomString($length = 10) {
    // //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // //     $charactersLength = strlen($characters);
    // //     $randomString = '';
    // //     for ($i = 0; $i < $length; $i++) {
    // //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    // //     }
    // //     return $randomString;
    // }

}
