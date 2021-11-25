<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use DB;

class PenjualanController extends Controller
{
    public function transaksi_show(){

        $data = Order::order_get_data_id_all();
        return view('seller_penjualan.transaksi_penjualan')->with('data',$data);
    }
    public function transaksi_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
   
       
       if($search){   
   
        $query = "order_id LIKE '%$search%' OR order_date LIKE '%$search%' OR no_invoice LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order WHERE $query )jumdata FROM fm_order WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_order)jumdata FROM fm_order LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }
       public function transaksi_edit($order_id)
       {
           $data = Order::order_get_by_id($order_id)[0];
           return view('seller_penjualan.transaksi_edit')->with('transaksi', $data);
       }


    public function transaksi_ubah($id){
        $add = Order::where('order_id',$id)->firstOrFail();
        $add->status = 'processed';
        
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
    }
    public function transaksi_tanpaedit($id){
        $add = Order::where('order_id',$id)->firstOrFail();
        $add->status = 'unprocessed';
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
    }
    public function transaksi_update(Request $request){

        $add = Order::where('order_id',$request->get('order_id'))->firstOrFail();
        $add->order_date = $request->get('order_date'); 
        $add->order_id = $request->get('order_id'); 
        $add->no_invoice = $request->get('no_invoice');
        $add->status = $request->get('status'); 
        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Svimpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        } 
        
    }
    public function transaksi_get($id){

        $data = Order::order_get_by_id($id);
      
       return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));
    
    }


}
