<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Seller;
use App\Order;
use App\Order_detail;
use App\Terimabarangbaru;
use App\KirimBrg;
use App\KirimBrgDtl;
use App\FmUser;
// use App\CategoryModel;
use DB;

class TerimabarangbaruController extends Controller
{
    
  public function tbb_save(Request $request){

   

//     if($result){
//          return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
//     }else{
//          return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
//     } 
    $maxAmount = KirimBrg::where('order_id', $request->order_id)->first()->amount;
    $amountData = count($request->uid);
    // dd($amountData,$maxAmount);
    if($amountData!=$maxAmount){
      
      return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>[], 'success'=>FALSE));
    }else{
    foreach ($request->uid as $index => $item) {
    $add = New Terimabarangbaru;
    $add->order_id= $request->order_id;
    $add->uid= $item;
    $add->product_name= $request->product_name[$index];
    $result = $add->save();

    }
    $barangs = Terimabarangbaru::where('order_id',$request->order_id)->get();
    foreach ($barangs as $item) {
    $summary=[
    
    ]

    }
      return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>[], 'success'=>TRUE));
    } 

}
    public function baru_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT name FROM fm_users WHERE user_id = fm_kirim_barang.user_id) as name";
       if($search){   
       
       
        $query = "(SELECT name FROM fm_users WHERE user_id = fm_kirim_barang.user_id) as name) LIKE '%$search%' OR no_invoice LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_kirim_barang WHERE $query )jumdata, $join FROM fm_kirim_barang WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_kirim_barang)jumdata, $join FROM fm_kirim_barang LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
        //   echo  "SELECT *,(select count(*) from fm_order)jumdata, $join FROM fm_order LIMIT $start,$length ";
   
          return $data;
   
       }

       public function tbb_datatable(){

          $data=[];
          $length = $_POST['length'];
          $start = $_POST['start'];
          $search = $_POST['search']['value'];
     
         
         if($search){   
     
          $query = "product_name LIKE '%$search%' uid LIKE '%$search%' ";
          $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_kirim_barang_detail WHERE $query )jumdata FROM fm_kirim_barang_detail WHERE $query LIMIT $start,$length ");
     
         }else{
     
          $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_kirim_barang_detail)jumdata FROM fm_kirim_barang_detail LIMIT $start,$length ");
          }
         //count total data
     
            $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
     
     
            return $data;
     
         }
     public function bttn_btl(Request $request){
      $btldt = KirimBrg::bttn_btl($request->id);
      return redirect('/barang');
    }
    public function tbb_invoice($order_id){      
      $dt = KirimBrg::get_data_id_all();
      $data= KirimBrg::tbb_get_by_id($order_id);  
      return view('terima_barang_baru.tbb')->with('data',$data[0])->with('dta',$dt);
    }
    public function terima_baru($order_id){

      $data['baru']= KirimBrg::tbb_get_by_id($order_id);
      $data['tbb']= KirimBrgDtl::krmdtl_by_order_id($order_id);
      
      return view('terima_barang_baru.tbb')->with('data',$data);
  }

  public function bttn_scan(Request $request)
  {
    $data['detail'] = KirimBrg::bttn_scan($request->uid);
    return response()->json([
      'data' => $data
    ], 201);
  }

     public function summary_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        // $quantity = "(SELECT count(*) as jum FROM fm_product WHERE order_detail_id)"
        $join = "(SELECT product_name FROM fm_order_detail WHERE order_detail_id= fm_kirim_barang.order_detail_id) as product_name,";
        $join .= "(SELECT quantity FROM fm_order_detail WHERE order_detail_id = fm_kirim_barang.order_detail_id) as quantity";
       if($search){   
       
       
        $query = "(SELECT product_name FROM fm_order_detail WHERE order_detail_id= fm_kirim_barang.order_detail_id) LIKE '%$search%' OR (SELECT quantity FROM fm_order_detail WHERE order_detail_id = fm_kirim_barang.order_detail_id) LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_kirim_barang WHERE $query )jumdata, $join FROM fm_kirim_barang WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_kirim_barang)jumdata, $join FROM fm_kirim_barang LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
        //   echo  "SELECT *,(select count(*) from fm_order)jumdata, $join FROM fm_order LIMIT $start,$length ";
   
          return $data;
   
     }

    public function baru_show(){

        $data = KirimBrg::get_data_id_all();
        return view('terima_barang_baru.baru_show')->with('data',$data);
    }
    public function tbb_show(){
        
        $data = KirimBrg::tbb_data_id();      
        return view('terima_barang_baru.tbb')->with('data',$data[0]);
    }
    public function summary_show(){
        
        $data = KirimBrg::summary_data_id();      
        return view('terima_barang_baru.summary')->with('data',$data[0]);
    }
    
    
   
public function baru_print($id){

$data = KirimBrg

::baru_print_by_id($id);
return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}

}