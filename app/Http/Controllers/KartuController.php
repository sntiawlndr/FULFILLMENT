<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kartu;
use App\Order_detail;
use App\Seller;
use App\ReceiptDetail;
use App\Receipt;
// use app\Keluarbarang;
use DB;

class KartuController extends Controller
{
    
 

    public function kartu_datatable()                                                                                                                                
    {

        $data = [];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
         $join = "(SELECT quantity FROM fm_order_detail WHERE order_detail_id = inventory_data.order_detail_id) as quantity";
  

        if ($search) {

            $query = "product_model LIKE '%$search%' OR product_name LIKE '%$search%'  OR quantity LIKE '%$search%'";
           $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_data WHERE $query )jumdata, $join FROM inventory_data  WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_data )jumdata, $join FROM inventory_data  LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }


    public function kartu_show()
    {

        $data = Kartu::get_data_id_all();
        return view('a_kartu_stok.kartu_show')->with('data', $data);
    }

     public function edit()
    {

        $data = Kartu::get_data_id_all();
    return view('a_kartu_stok.edit')->with('data', $data);
    }

    public function kartu_detail($inventory_id){
        // $data['barang'] = Barang::barang_get_by_id($seller_id)[0];
        // $data['barang'] = Barang::barang_get_by_id($category_id)[0];

        $data['kartu'] = Kartu::kartu_get_by_id($inventory_id)[0];     
        
       	$data['seller'] = Seller::seller_get_by_id($data['kartu']->seller_id)[0];  
        $data['orderdetail'] = Order_detail::orderdetail_get_by_id($data['kartu']->order_detail_id)[0];
        
        return view('a_kartu_stok.detail')->with('data',$data);
        
    }

public function edit_datatable(){

     $data=[];
     $length = $_POST['length'];
     $start = $_POST['start'];
     $search = $_POST['search']['value'];

    
    if($search){   

     // $query = "category_name LIKE '%$search%' ";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_data WHERE $query )jumdata FROM inventory_data WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_data)jumdata FROM inventory_data LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }

public function detail_datatable()
    {

        $data = [];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT receipt_date FROM inventory_receipt WHERE receipt_id = inventory_data.receipt_id) as receipt_date,";
        $join .= "(SELECT receipt_qty FROM inventory_receipt_detail WHERE receipt_detail = inventory_data.receipt_detail) as receipt_qty, ";
        // $join .= "(SELECT count(*)as jum,product_id FROM inventory_out GROUP by product_id, ";
        $join .= "(SELECT total_qty FROM inventory_receipt WHERE receipt_id = inventory_data.receipt_id) as total_qty ";

  

        if ($search) {

            $query = "receipt_date LIKE '%$search%' OR receipt_qty LIKE '%$search%'  OR request_qty LIKE '%$search%'";
           $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_data WHERE $query )jumdata, $join FROM inventory_data  WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_data )jumdata, $join FROM inventory_data  LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }
    // public function gudang_update(Request $request)
    // {

    //     $add = Gudang::where('location_id', $request->get('location_id'))->firstOrFail();
    //     $ads = Address::where('address_id', $request->get('address_id'))->firstOrFail();


    //     $add->location_name = $request->get('location_name');
    //     $add->location_code = $request->get('location_code');
    //     $add->address_id = $request->get('address_id');
    //     $ads->address = $request->get('address');
    //     $ads->address_telepon = $request->get('address_telepon');
    //     $result = $add->save();
    //     $resultads = $ads->save();

    //     if ($result && $resultads) {
    //         return json_encode(array('msg' => 'Simpan Data Berhasil', 'content' => $result, 'success' => TRUE));
    //     } else {
    //         return json_encode(array('msg' => 'Gagal Menyimpan Data', 'content' => $result, 'success' => FALSE));
    //     }
    // }



//     public function gudang_delete($id)
//     {
//         $delete = Gudang::gudang_delete($id);
//         return redirect('/gudang');
//     }


//     public function kartu_get($id){

//         $data = kartu::kartu_get_by_id($id);
//  return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));

// }


}


