<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Seller;
use App\CategoryModel;
use App\Location;
use App\MyController;
use DB;

class BarangController extends Controller
{
    function index(){
        $data['sellers']= Seller::get_data_id_all(); //yg td diedit
        // $data= Seller::get_data_id_all();
        $data['categories']= CategoryModel::get_data_id_all();//yg td diedit
        return view('admin_barang.barang_add')->with('data',$data);//yg td diedit
    }

    public function barang_save(Request $request){

        $add = New Barang;
        $add->seller_id= $request->get('seller_id'); 
        $add->category_id= $request->get('category_id'); 
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
    $join = "(SELECT category_name FROM fm_category WHERE category_id = fm_product.category_id) as category_name,";
    $join .= "(SELECT seller_name FROM fm_seller WHERE seller_id = fm_product.seller_id) as seller_name "; 
    if($search){   
    
    
     $query = "seller_id LIKE '%$search%' OR category_id LIKE '%$search%' OR  product_name LIKE '%$search%'  OR product_sku LIKE '%$search%'  OR size LIKE '%$search%'  OR product_status LIKE '%$search%'";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_product WHERE $query )jumdata, $join FROM fm_product WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_product)jumdata, $join FROM fm_product LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }

    //Detail Barang
    public function detail_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
       $join = "(SELECT uid FROM inventory_data WHERE inventory_id = fm_product.inventory_id ) as uid,";
       $join .= "(SELECT location_name FROM warehouse_location WHERE location_id = fm_product.location_id) as location_name";
       if($search){   
       
       
        $query = "seller_id LIKE '%$search%' OR product_name LIKE '%$search%'  OR product_sku LIKE '%$search%'  OR size LIKE '%$search%'  OR product_status LIKE '%$search%' OR category_id LIKE '%$search%' ";
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

    public function detail_show(){

        $data = Barang::get_data_id_d();
        return view('admin_barang.detail')->with('data',$data);
    }
    
    public function upload_show(){

        $data = Barang::get_data_id();
        return view('admin_barang.barang_upload')->with('data',$data);
    } 

    public function barang_edit($product_id){
        // $data['barang'] = Barang::barang_get_by_id($seller_id)[0];
        // $data['barang'] = Barang::barang_get_by_id($category_id)[0];

        $data['barang'] = Barang::barang_get_by_id($product_id)[0];
        $data['sellers'] = Seller::seller_get_by_id($data['barang']->seller_id)[0];
        $data['categories'] = CategoryModel::category_get_by_id($data['barang']->category_id)[0];  
        return view('admin_barang.barang_edit')->with('data',$data);
        
    }
 // Detai Barang
    public function barang_detail($product_id){
        // $data['barang'] = Barang::barang_get_by_id($seller_id)[0];
        // $data['barang'] = Barang::barang_get_by_id($category_id)[0];

        $data['barang'] = Barang::detail_get_by_id($product_id)[0];
        $data['seller'] = Seller::seller_get_by_id($data['barang']->seller_id)[0];  //yg td diedit
        $data['category'] = CategoryModel::category_get_by_id($data['barang']->category_id)[0];    //yg td diedit  
        return view('admin_barang.detail')->with('data',$data);

    }

     public function barang_update(Request $request){
        
        $add = Barang::where('product_id',$request->get('product_id'))->firstOrFail();
        $add->seller_id = $request->get('seller_id'); 
        $add->category_id = $request->get('category_id');
        $add->product_name = $request->get('product_name'); 
        $add->product_sku = $request->get('product_sku'); 
        $add->size = $request->get('size'); 
        $add->product_status = $request->get('product_status');
        $result = $add->save();
        // $add = Barang::where('product_id',$request->get('product_id'))->firstOrFail();
        // $adb = Seller::where('seller_id',$request->get('seller_id'))->firstOrFail();
        // $adc = CategoryModel::where('category_id',$request->get('category_id'))->firstOrFail();

        // $add->seller_id = $request->get('seller_id'); 
        // $add->category_id = $request->get('category_id'); 
        
         
        // $add->product_name = $request->get('product_name'); 
        // $add->product_sku = $request->get('product_sku'); 
        // $add->size = $request->get('size'); 
        // $add->product_status = $request->get('product_status');
        // $result = $add->save();
        // $hasil = $adb->save();
        // $ini = $adc->save();
        

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

    //  $data = Barang::barang_get_by_id($id);
    $join = "(SELECT category_name FROM fm_category WHERE category_id = fm_product.category_id) as category_name,";
    $join .= "(SELECT seller_name FROM fm_seller WHERE seller_id = fm_product.seller_id) as seller_name "; 
    $data= DB::SELECT("SELECT *, $join FROM fm_product WHERE product_id = $id");
    return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}
public function barang_print($id){

    $data = Barang::barang_get_by_id($id);
  
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
		Excel::import(new Upload, public_path('/file_barang/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('Sukses','Data Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/upload');
	}


}