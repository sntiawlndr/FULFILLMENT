<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Seller;
use App\Sellerbarang;
use App\CategoryModel;

use DB;

class SellerbarangController extends Controller
{
    function index(){        
        $data= CategoryModel::get_data_id_all();        
        return view('seller_barang.selbrg_add')->with('categories',$data);//yg td diedit
    }

    public function seller_save(Request $request){

        $add = New seller;
        $add->category_id= $request->get('category__id'); 
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

    public function seller_datatable(){

     $data=[];
     $length = $_POST['length'];
     $start = $_POST['start'];
     $search = $_POST['search']['value'];
    $join = "(SELECT category_name FROM fm_category WHERE category_id = fm_product.category_id) as category_name";
    if($search){   
    
    
     $query = "product_name LIKE '%$search%'  OR product_sku LIKE '%$search%'  OR size LIKE '%$search%'  OR product_status LIKE '%$search%'";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_product WHERE $query )jumdata, $join FROM fm_product WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_product)jumdata, $join FROM fm_product LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }

    public function seller_show(){

        $data = seller::get_data_id_all();
        return view('seller_barang.selbrg_show')->with('data',$data);
    }
    public function upload_show(){

        $data = seller::get_data_id();
        return view('seller_barang.selbrg_upload')->with('data',$data);
    }

    public function seller_edit($category_id){
        $data['barang'] = Barang::seller_get_by_id($category_id)[0];
        $data['categories'] = CategoryModel::get_data_id_all(); 
        return view('seller_barang.selbrg_edit')->with('data',$data);
    }

     public function seller_update(Request $request){
        $add = Barang::where('product_id',$request->get('product_id'))->firstOrFail();
        $add->category_id = $request->get('category_id'); //yg td di edit
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



    public function seller_delete($id){
        $delete = seller::seller_delete($id);
        return redirect('/seller');
    }


    public function seller_get($id){

        $data = seller::seller_get_by_id($id);
 return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}
public function seller_print($id){

    $data = seller::seller_print_by_id($id);
return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}
public function import_data(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_siswa',$nama_file);
 
		// import data
		Excel::import(new Upload, public_path('/file_seller/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('Sukses','Data Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/upload');
	}


}