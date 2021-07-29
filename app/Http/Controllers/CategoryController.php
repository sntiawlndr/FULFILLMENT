<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;
use App\ParentModel;
use DB;

class CategoryController extends Controller
{

    function index(){
        $data = CategoryModel::get_data_id_all();
    
        // $data = ParentModel::category_get_by_id($category_id);
        return view('category.catagory_add')->with('categories',$data);
        
        
    }


    public function category_save(Request $request){

        $add = New CategoryModel;
        $add->category_parent_id = $request->get('category_parent_id');
        $add->category_name = $request->get('category_name'); 
        $add->category_status = $request->get('category_status');
        $result = $add->save();

        if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }

    public function category_datatable(){

     $data=[];
     $length = $_POST['length'];
     $start = $_POST['start'];
     $search = $_POST['search']['value'];

    
    if($search){   

     $query = "category_name LIKE '%$search%' ";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_category WHERE $query )jumdata FROM fm_category WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_category)jumdata FROM fm_category LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }

    public function category_show(){

        $data = CategoryModel::get_data_id_all();
        return view('category.category_show')->with('data',$data);
    }

    public function category_edit($category_id){
        $categories = CategoryModel::get_data_id_all();
        $data = CategoryModel::category_get_by_id($category_id);
        
        return view('category.category_edit')->with('category',$data[0])->with('categories',$categories);
    }

     public function category_update(Request $request){

        $add = CategoryModel::where('category_id',$request->get('category_id'))->firstOrFail();
        $add->category_parent_id = $request->get('category_parent_id');  
        $add->category_name = $request->get('category_name'); 
        $add->category_status = $request->get('category_status');
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }



    public function category_delete($id){
        $delete = CategoryModel::category_delete_by_id($id);
        return redirect('/category');
    }


    public function category_get($id){

        $data = CategoryModel::category_get_by_id($id);
 return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));

}


}
