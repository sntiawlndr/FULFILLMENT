<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
use App\Seller;
use App\Order;
use App\OrderDetail;
use App\Terimabarangbaru;
// use App\CategoryModel;
use DB;

class PackingController extends Controller
{
    function index(){
        $data['inventories']= Terimabarangbaru::get_data_id_all();
        $data['orders'] = Order::get_data_id_all();
        return view('admin_packing.packing_show')->with('data',$data);
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

    public function packing_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
       $join = "(SELECT no_invoice FROM fm_order WHERE order_id = inventory_data.order_id) as no_invoice "; 
       if($search){   
       
       
        $query = "product_name LIKE '%$search%' OR no_invoice LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_data WHERE $query )jumdata, $join FROM inventory_data WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_data)jumdata, $join FROM inventory_data LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }
       public function packing_data(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT product_name FROM fm_product WHERE product_id = fm_order_detail.product_id) as product_name";
       if($search){   
       
       
        $query = "quantity LIKE '%$search%' OR product_name LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order_detail WHERE $query )jumdata, $join FROM fm_order_detail WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_order_detail)jumdata, $join FROM fm_order_detail LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }


    public function packing_show(){

        $data = Barang:: get_data_id_all();
        return view('admin_packing.packing_show')->with('data',$data);
    }
    
    public function barang_get($id){

        $data = Barang::barang_get_by_id($id);
 return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}
public function barang_print($id){

    $data = Barang::barang_print_by_id($id);
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

