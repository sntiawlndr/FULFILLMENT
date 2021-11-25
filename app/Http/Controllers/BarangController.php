<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Seller;
use App\CategoryModel;
use App\Location;
use App\MyController;
use App\FmUser;
use App\Http\Controllers\Controller;
use DataTables;
use DB;

class BarangController extends Controller
{
    function index(){
        $data['sellers']= FmUser::get_data_id_all(); //yg td diedit
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
    $join .= "(SELECT name FROM fm_users WHERE user_id = fm_product.user_id) as name "; 
   
    if($search){  
        $filters = [];
        if(!empty($_POST['status'])){
            $filters[] = "fm_product.product_status ='".$_POST['status']."'";            
           }
           if(!empty($_POST['seller'])){
            $filters[] = "fm_product.name ='".$_POST['seller']."'";            
           }
           if(!empty($_POST['ukuran'])){
            $filters[] = "fm_product.size ='".$_POST['ukuran']."'";            
           }
           $filters = (count($filters)>0) ? implode(" AND ",$filters)." AND ":"";
    
     $query = "$filters ((SELECT name FROM fm_users WHERE user_id = fm_product.user_id) LIKE '%$search%' OR (SELECT category_name FROM fm_category WHERE category_id = fm_product.category_id)LIKE '%$search%' OR  product_name LIKE '%$search%'  OR product_sku LIKE '%$search%'  OR size LIKE '%$search%'  OR product_status LIKE '%$search%')";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_product WHERE $query )jumdata, $join FROM fm_product WHERE $query LIMIT $start,$length ");

    }else{
        $filters = [];
        if(!empty($_POST['status'])){
            $filters[] = "fm_product.product_status ='".$_POST['status']."'";            
           }
           if(!empty($_POST['seller'])){
            $filters[] = "fm_product.user_id ='".$_POST['seller']."'";            
           }
           if(!empty($_POST['ukuran'])){
            $filters[] = "fm_product.size ='".$_POST['ukuran']."'";            
           }
           $filters = (count($filters)>0) ? " WHERE ".implode(" AND ",$filters):"";
    

     $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_product)jumdata, $join FROM fm_product $filters LIMIT $start,$length ");
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
        $seller_id =$_POST['seller_id'];
    
      
     if($search){  
        $filters = "";
        if(!empty($_POST['status'])){

            $filters = "inventory_data.inventory_status ='".$_POST['status']."' && ";
            
           }    
       
       
        $query = "$filters ( seller_id ='$seller_id' and (UID LIKE '%$search%' OR product_name LIKE '%$search%'  OR product_model LIKE '%$search%'  OR inventory_status LIKE '%$search%'))";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_data WHERE $query )jumdata FROM inventory_data WHERE $query LIMIT $start,$length ");
   
       }else{
        $filters = " WHERE seller_id = '$seller_id' ";

        if(!empty($_POST['status'])){

            $filters .= "AND inventory_data.inventory_status ='".$_POST['status']."'";
            
           }
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_data)jumdata FROM inventory_data $filters   LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }

    public function barang_show(){

        $data['barangs']= Barang::get_data_id_all();
        $data['sellers']= FmUser::get_data_id_all(); //yg td diedit
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
  // Detailw Barang
  public function barang_detail($product_id){
    // $data['barang'] = Barang::barang_get_by_id($seller_id)[0];
    // $data['barang'] = Barang::barang_get_by_id($category_id)[0];

    $data['barang'] = Barang::detail_get_by_id($product_id)[0];
    $data['seller'] = Seller::seller_get_by_id($data['barang']->seller_id)[0];  //yg td diedit
    $data['category'] = CategoryModel::category_get_by_id($data['barang']->category_id)[0]; 
    $data['d'] = $data['barang']->seller_id; //yg td diedit  
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
// Public function filter_barang(Request $request)
//    {
//         if ($request->ajax()) {
//             $data = Barang::select('*');
//             return Datatables::of($data)
//                     ->addIndexColumn()
//                     ->addColumn('status', function($row){
//                          if($row->status){
//                             return '<span class="badge badge-primary">S</span>';
//                         }else{
//                             return '<span class="badge badge-danger">M</span>';
                       
//                          }

//                     })
//                     ->filter(function ($instance) use ($request) {
//                         if ($request->get('product_status') == '0' || $request->get('product_status') == '1') {
//                             $instance->where('product_status', $request->get('product_status'));
//                         }
                        
//                         if (!empty($request->get('search'))) {
//                              $instance->where(function($w) use($request){
//                                 $search = $request->get('search');
//                                 $w->orWhere('S', 'LIKE', "%$search%")
//                                 ->orWhere('M', 'LIKE', "%$search%");
//                             });
//                         }
//                     })
//                     ->rawColumns(['product_status'])
//                     ->make(true);
//         }
        
//         return view('admin_barang.barang_show');
//     }
public function barang_print($id){

    $data = Barang::barang_get_by_id($id);
  
   return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}
public function generate ($id)
{
    $data = Data::findOrFail($id);
    $qrcode = QrCode::size(400)->generate($data->name);
    return view('qrcode',compact('qrcode'));
}
public function fildown(Request $request)
    {
        if ($request->ajax()) {
            $data = Barang::select('*');
            $join = "(SELECT category_name FROM fm_category WHERE category_id = fm_product.category_id) as category_name,";
            $join .= "(SELECT seller_name FROM fm_seller WHERE seller_id = fm_product.seller_id) as seller_name "; 
            return DataTables::of($data)
                    ->addIndexColumn()
                    
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('status') == 'disable' || $request->get('status') == 'enable') {
                            $instance->where('status', $request->get('status'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('product_id', 'LIKE', "%$search%")                                
                                ->orWhere('product_name', 'LIKE', "%$search%")                                
                                ->orWhere('status', 'LIKE', "%$search%");
                              
                            });
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        
        return view('admin_barang.barang_show');
    }

public function import(Request $request) 
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
		// $file->move('barang_upload',$nama_file);
 
		// import data
		Excel::import(new Barang, public_path($file));
 
		// notifikasi dengan session
		
 
		// alihkan halaman kembali
		return redirect('barang_upload');
	}

    public function printbar()
    {
       
        return view('admin_barang.testbar');
    }


}