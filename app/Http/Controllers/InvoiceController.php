<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use DB;

class InvoiceController extends Controller
{
    function index(){
        
        return view('seller_invoice.invoice_add');
    }

    public function invoice_datatable(){

     $data=[];
     $length = $_POST['length'];
     $start = $_POST['start'];
     $search = $_POST['search']['value'];
   

    
    if($search){   

     $query = "no_invoice LIKE '%$search%' OR order_email LIKE '%$search%' OR order_telpon LIKE '%$search%' OR customer_name LIKE '%$search%' OR order_status LIKE '%$search%'";
     $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order WHERE $query )jumdata FROM fm_order WHERE $query LIMIT $start,$length ");

    }else{

     $data['data']= DB::SELECT("SELECT *,(select count(*) from fm_order)jumdata FROM fm_order LIMIT $start,$length ");
     }
    //count total data

       $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;


       return $data;

    }

    public function invoice_show(){
        $data = Order::order_get_data_id_all();
        return view('seller_invoice.invoice_show')->with('data',$data);
    }

   

    public function invoice_get($id){
        $data = Order::order_get_by_id($id);
        return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));
    }

    // public function invoice_detail($order_id){
        
    //     $data = Order::order_get_by_id($order_id);
    //     echo $data;
    //     exit;
    //     return view('seller_invoice.detail')->with('order',$data[0]);
    // }
    public function invoice_edit($order_id){
        $data = Order::order_get_by_id($order_id);

        return view('seller_invoice.detail')->with('order',$data[0]);
    }



}
