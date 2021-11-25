<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Seller;
use App\Role;
use App\GroupSeller;
use App\Address;
use App\CitiesModel;
use App\ProvincesModel;
use Illuminate\Support\Facades\Hash;

use DB;

class SellerController extends Controller
{
    function index(){
        $data['groupsellers'] = GroupSeller::get_data_id_all();
        $data['addresses']= Address::get_data_id_all();
        $data['cities']= CitiesModel::get_data_id_all();
        $data['provinces']= ProvincesModel::get_data_id_all();
        return view('seller.seller_add')->with('data',$data);
        // $data = Seller::get_data_id_all();
        // return view('admin_barang.barang_add')->with('sellers',$data);
    }


    public function seller_save(Request $request){
        
        $ads = New Address;
        $ads->address = $request->get('address');
        $ads->address_city = $request->get('address_city');
        $ads->address_districts = $request->get('address_kec');
        $ads->address_postal_code = $request->get('address_postal_code');

        $alamat =$ads->save();

        if($alamat){
            $add = New Seller;
            $add->address_id = $ads->address_id;
            $add->seller_email = $request->get('seller_email'); 
            $add->seller_telpon = $request->get('seller_telpon'); 
            $add->seller_status= $request->get('seller_status'); 
            $add->seller_name = $request->get('seller_name'); 
            $add->seller_group_id = $request->get('seller_group_id'); 
                
            $result = $add->save();
        }
            if($result && $alamat){
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
     $join = "(SELECT group_name FROM seller_group WHERE seller_group_id = fm_seller.seller_group_id) as group_name "; 

    
    if($search){   

     $query = "seller_group_id LIKE '%$search%' OR seller_email LIKE '%$search%' OR seller_telpon LIKE '%$search%' OR seller_name LIKE '%$search%' OR group_role LIKE '%$search%'";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_seller WHERE $query )jumdata, $join FROM fm_seller WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_seller)jumdata, $join FROM fm_seller LIMIT $start,$length ");
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
        
        $data['seller'] = Seller::seller_get_by_id($seller_id)[0];
        $data['groupsellers'] = GroupSeller::group_get_by_id($data['seller']->seller_group_id)[0]; 
        return view('seller.seller_edit')->with('data',$data);
    }

     public function seller_update(Request $request){

        $add = Seller::where('seller_id',$request->get('seller_id'))->firstOrFail();
        $add->seller_email = $request->get('seller_email'); 
        $add->seller_telpon = $request->get('seller_telpon'); 
        $add->seller_name = $request->get('seller_name'); 
        $add->seller_group_id= $request->get('seller_group_id'); 
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
    // public function ganti_show(){
        
    //     $data = Seller::ganti_data_id();      
    //     return view('seller.ganti_password')->with('data',$data[0]);
    // }


    public function seller_get($id){

        $data = Seller::seller_get_by_id($id);
    return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));

    }
    public function ganti_password($seller_id){
        $data = Seller::seller_get_by_id($seller_id);

        return view('seller.ganti_password')->with('seller',$data[0]);
    }
    public function update_password(Request $request){

        $add = Seller::where('seller_id',$request->get('seller_id'))->firstOrFail();
          
        $add->seller_password = Hash::make($request->get('seller_password')); 
    
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 


}
}