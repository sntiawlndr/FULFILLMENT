<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use DB;

class ProductController extends Controller
{
    function index(){
        
        return view('product.product_add');
    }


    public function product_save(Request $request){
        

        $add = New ProductModel;
        $add->product_name = $request->get('product_name'); 
        $add->product_description = $request->get('description');
        $result = $add->save();

        if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }

    public function product_datatable(){

     $data=[];
     $length = $_POST['length'];
     $start = $_POST['start'];
     $search = $_POST['search']['value'];

    
    if($search){   

     $query = "product_name LIKE '%$search%' OR product_description LIKE '%$search%'";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from product WHERE $query )jumdata FROM product WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from product)jumdata FROM product LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }

    public function product_show(){

        $data = ProductModel::get_data_id_all();
        return view('product.product_show')->with('data',$data);
    }

    public function product_edit($product_id){
        $data = ProductModel::product_get_by_id($product_id);
        return view('product.product_edit')->with('product',$data[0]);
    }

     public function product_update(Request $request){

        $add = ProductModel::where('product_id',$request->get('product_id'))->firstOrFail();
          
        $add->product_name = $request->get('product_name'); 
        $add->product_description = $request->get('description');
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }



    public function product_delete($id){
        $delete = ProductModel::product_delete($id);
        return redirect('/product');
    }


    public function product_get($id){

        $data = productModel::product_get_by_id($id);
 return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));

}


}
