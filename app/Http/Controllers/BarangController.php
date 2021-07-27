<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Seller;
// use App\CategoryModel;
use DB;

class BarangController extends Controller
{
    function index(){
        $data = Seller::get_data_id_all();
        return view('admin_barang.barang_add')->with('sellers',$data);
    }

    public function barang_save(Request $request){

        $add = New Barang;
        $add->seller_id= $request->get('seller_id'); 
        $add->product_name = $request->get('product_name'); 
        $add->product_sku = $request->get('product_sku'); 
        $add->size = $request->get('size'); 
        $add->product_status = $request->get('product_status'); 
        $result = $add->save();

        if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }

    public function barang_datatable(){

     $data=[];
     $length = $_POST['length'];
     $start = $_POST['start'];
     $search = $_POST['search']['value'];
    $join = "(SELECT category_name FROM fm_category WHERE category_id = fm_product.category_id) as category_name, ";
    $join .= "(SELECT seller_name FROM fm_seller WHERE seller_id = fm_product.seller_id) as seller_name "; 
    if($search){   
    
    
     $query = "seller_id LIKE '%$search%' OR product_name LIKE '%$search%'  OR product_sku LIKE '%$search%'  OR size LIKE '%$search%'  OR product_status LIKE '%$search%'";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_product WHERE $query )jumdata, $join FROM fm_product WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_product)jumdata, $join FROM fm_product LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }

    public function barang_show(){

        $data = Barang::get_data_id_all();
        return view('admin_barang.barang_show')->with('data',$data);
    }
    public function upload_show(){

        $data = Barang::get_data_id();
        return view('admin_barang.barang_upload')->with('data',$data);
    }

    public function barang_edit($seller_id){
        $data['barang'] = Barang::barang_get_by_id($seller_id)[0];
        $data['sellers'] = Seller::get_data_id_all();       
        return view('admin_barang.barang_edit')->with('data',$data);
    }

     public function barang_update(Request $request){
        $add = Barang::where('product_id',$request->get('product_id'))->firstOrFail();
        $add->seller_id = $request->get('seller_id'); 
        $add->product_name = $request->get('product_name'); 
        $add->product_sku = $request->get('product_sku'); 
        $add->size = $request->get('size'); 
        $add->product_status = $request->get('product_status');
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }



    public function barang_delete($id){
        $delete = Barang::barang_delete($id);
        return redirect('/barang');
    }


    public function barang_get($id){

        $data = Barang::barang_get_by_id($id);
 return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));

}


}
