<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Barang;
use App\InventoryOut;
use App\InventoryReceipt;

use DB;

class SellerInvoiceController extends Controller
{
    function index(){
        
        return view('seller_invoice.invoice_add');
    }

    public function sellerinvoice_datatable(){

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

    public function seller_invoice_show(){
        $data = Order::order_get_data_id_all();
        return view('s_invoice_seller.seller_invoice_show')->with('data',$data);
    }

   

    public function invoice_get($id){
        $data = Order::order_get_by_id($id);
        return json_encode(array('msg'=>'Sava Data Success', 'content'=>$data, 'success'=>TRUE));
    }


    public function seller_invoice/detail($order_id){
        $data = Order::order_get_by_id($order_id);

        return view('s_invoice_seller.detail')->with('order',$data[0]);
    }
    public function bayar_show(){
        
        $data = Order::bayar_data_id();      
        return view('seller_invoice.bayar')->with('data',$data[0]);
    }

    public function detail_datatable(){
 
        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT product_name FROM fm_product WHERE product_id = inventory_receipt.product_id) as product_name, ";
        $join .= "(SELECT size FROM fm_product WHERE product_id = inventory_receipt.product_id) as size ";
      
         if($search){   
       
       
        $query = "product_id LIKE '%$search%'  OR receipt_date LIKE '%$search%'  OR total_qty LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_receipt WHERE $query )jumdata, $join FROM inventory_receipt WHERE $query LIMIT $start,$length ");

        }else{

        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_receipt)jumdata, $join FROM inventory_receipt LIMIT $start,$length ");
        }
        //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }

       public function detail_data(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT size FROM fm_product WHERE product_id = inventory_out.product_id) as size ";
      
         if($search){   
       
       
        $query = "product_id LIKE '%$search%'  OR product_name LIKE '%$search%'  OR date_out LIKE '%$search%'  OR quantity LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_out WHERE $query )jumdata, $join FROM inventory_out WHERE $query LIMIT $start,$length ");

        }else{

        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_out)jumdata, $join FROM inventory_out LIMIT $start,$length ");
        }
        //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
   
   
          return $data;
   
       }
}
