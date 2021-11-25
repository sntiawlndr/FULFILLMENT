<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Seller;
use App\Order;
use App\Order_detail;
use App\FmUser;;
use App\Terimabaranglama;
// use App\CategoryModel;
use DB;

class TerimabaranglamaController extends Controller
{
    function index(){
        $data = FmUser::get_data_id_all();
        $data = Order::get_data_id_all();
        return view('terima_barang_baru.lama_show')->with('sellers',$data);
    }
    
    public function tbl_save(Request $request){

        $add = New Order_detail;
        $add->uid= $request->get('uid');
        $add->product_name= $request->get('product_name');
        $result = $add->save();
    
        if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }
    public function tbl_update(Request $request){
        
        $add = Order_detail::where('order_detail_id',$request->get('order_detail_id'))->firstOrFail();
        $add->uid= $request->get('uid');
        $add->product_name= $request->get('product_name');
        $result = $add->save();
        

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }

    public function lama_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
       $join = "(SELECT name FROM fm_users WHERE user_id = fm_order.user_id) as name";      
       if($search){   
       
       
        $query = "(SELECT name FROM fm_users WHERE user_id = fm_order.user_id) LIKE '%$search%' OR no_invoice LIKE '%$search%' OR amount LIKE '%$search%'" ;
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order WHERE $query )jumdata, $join FROM fm_order WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_order)jumdata, $join FROM fm_order LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }
       public function tbl_invoice($order_id){      
        $dt = Terimabaranglama::get_data_id_all();
        $data= Terimabaranglama::edit_get_by_id($order_id);  
        return view('terima_barang_lama.tbl')->with('ventory',$data[0])->with('dta',$dt);
            
        }
       public function tbl_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
   
       
       if($search){   
   
        $query = "product_name LIKE '%$search%' uid LIKE '%$search%' ";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order_detail WHERE $query )jumdata FROM fm_order_detail WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_order_detail)jumdata FROM fm_order_detail LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }

    public function lama_show(){

        $data = Terimabaranglama::get_data_id_all();
        return view('terima_barang_lama.lama_show')->with('data',$data);
    }
    public function tbl_show(){

        $data = Terimabaranglama::tbl_data_id();
        return view('terima_barang_lama.tbl')->with('data',$data);
    }
    
    public function terima_lama($order_id){

        $data['lama']= Terimabaranglama::edit_get_by_id($order_id);
        $data['tbl']= Order_detail::orderdetail_get_by_order_id($order_id);
        return view('terima_barang_lama.tbl')->with('data',$data);
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
    public function tbl_cek($id){

        $data = Terimabaranglama::tbl_data_id();
        return view('terima_barang_lama.tbl')->with('data',$data);
        //  $data = Barang::barang_get_by_id($id);
        // $join = "(SELECT category_name FROM fm_category WHERE category_id = fm_product.category_id) as category_name,";
        // $join .= "(SELECT seller_name FROM fm_seller WHERE seller_id = fm_product.seller_id) as seller_name "; 
        // $data= DB::SELECT("SELECT *, $join FROM fm_product WHERE product_id = $id");
        // return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));
    
    }

}