<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Seller;
use App\Order;
use App\Terimabarangbaru;
// use App\CategoryModel;
use DB;

class TerimabarangbaruController extends Controller
{
    function index(){
        $data['sellers']= Seller::get_data_id_all();
        $data['orders'] = Order::get_data_id_all();
        return view('terima_barang_baru.baru_show')->with('data',$data);
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

    public function baru_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
       $join .= "(SELECT seller_name FROM fm_seller WHERE seller_id = inventory_data.seller_id) as seller_name ";
       $join .= "(SELECT amount FROM fm_order WHERE order_id = inventory_data.order_id) as amount "; 
       $join .= "(SELECT no_invoice FROM fm_order WHERE order_id = inventory_data.order_id) as no_invoice "; 
       if($search){   
       
       
        $query = "seller_name LIKE '%$search%' OR no_invoice LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_data WHERE $query )jumdata, $join FROM inventory_data WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_data)jumdata, $join FROM inventory_data LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }

    public function baru_show(){

        $data = Terimabarangbaru::get_data_id_all();
        return view('terima_barang_baru.baru_show')->with('data',$data);
    }
    public function tbb_show(){

        $data = Terimabarangbaru::tbb_data_id();
        return view('terima_barang_baru.tbb')->with('data',$data);
    }
    
    public function barang_get($id){

        $data = Barang::barang_get_by_id($id);
 return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}
public function baru_print($id){

    $data = Barang::baru_print_by_id($id);
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
