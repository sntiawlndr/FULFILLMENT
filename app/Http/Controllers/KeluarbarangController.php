<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Keluarbarang;
use App\Seller;
use App\Barang;
use App\Order;
use App\Location;
use App\Terimabarangbaru;
use App\Terimabaranglama;
use DB;

class KeluarbarangController extends Controller
{
    public function keluar_datatable(){

        $data=[];
        // print_r('data');
        // exit;
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT no_invoice FROM fm_order WHERE order_id = inventory_out.order_id) as no_invoice,";
       $join .= "(SELECT seller_name FROM fm_seller WHERE seller_id = inventory_out.seller_id) as seller_name,";
       $join .= "(SELECT seller_status FROM fm_seller WHERE seller_id = inventory_out.seller_id) as seller_status,";
       $join .= "(SELECT amount FROM fm_order WHERE order_id = inventory_out.order_id) as amount,"; 
       $join .= "(SELECT location_status FROM warehouse_location WHERE location_id = inventory_out.location_id) as location_status"; 
       if($search){   
       
       
        $query = "seller_name LIKE '%$search%' OR no_invoice LIKE '%$search%' OR amount LIKE '%$search%' location_status LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_out WHERE $query )jumdata, $join FROM inventory_out WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_out)jumdata, $join FROM inventory_out LIMIT $start,$length ");

        
    }
        
       //count total data
        
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
          // echo "SELECT *,(select count(*) from inventory_out)jumdata, $join FROM inventory_out LIMIT $start,$length";
   
          return $data;
   
       }

       public function detail_keluar_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT seller_name FROM fm_seller WHERE seller_id = inventory_out.seller_id) as seller_name,";
        $join .= "(SELECT product_name FROM fm_product WHERE product_id = inventory_out.product_id) as product_name,";
        $join .= "(SELECT product_sku FROM fm_product WHERE product_id= inventory_out.product_id) as product_sku ,";
        $join .= "(SELECT size FROM fm_product WHERE product_id = inventory_out.product_id) as size";
       if($search){   
       
       
        $query = "seller_name LIKE '%$search%' OR product_name LIKE '%$search%' OR product_sku LIKE '%$search%' OR product_sku LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_out WHERE $query )jumdata, $join FROM inventory_out WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_out)jumdata, $join FROM inventory_out LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
        //   echo  "SELECT *,(select count(*) from inventory_data)jumdata, $join FROM inventory_data LIMIT $start,$length ";
   
          return $data;
   
     } public function proses_keluar_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT seller_name FROM fm_seller WHERE seller_id = inventory_out.seller_id) as seller_name,";
        $join .= "(SELECT product_sku FROM fm_product WHERE product_id= inventory_out.product_id) as product_sku, ";
        $join .= "(SELECT size FROM fm_product WHERE product_id = inventory_out.product_id) as size,";
        $join .= "(SELECT amount FROM fm_order WHERE order_id = inventory_out.order_id) as amount,";
        $join .= "(SELECT location_name FROM warehouse_location WHERE location_id = inventory_out.location_id) as location_name";

       if($search){   
       
       
        $query = "seller_name LIKE '%$search%' OR product_name LIKE '%$search%' OR product_sku LIKE '%$search%' OR product_sku LIKE '%$search%' OR amount LIKE '%$search%' OR product_size LIKE '%$search%' OR location_nameLIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_out WHERE $query )jumdata, $join FROM inventory_out WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_out)jumdata, $join FROM inventory_out LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
        //   echo  "SELECT *,(select count(*) from inventory_data)jumdata, $join FROM inventory_data LIMIT $start,$length ";
   
          return $data;
   
     }



    public function keluar_show(){

        $data = Keluarbarang::get_data_id_all();
        // print_r('data');
        // exit;
        return view('admin_keluar.keluar')->with('data',$data);
    }
    public function detail_keluar_show(){
        
        $data = Keluarbarang::detail_data_id_all();
        return view('admin_keluar.detail_keluar')->with('data',$data);
    }
    public function proses_keluar_show(){
        
        $data = Keluarbarang::proses_data_id_all();
        return view('admin_keluar.proses_keluar')->with('data',$data);
    }
    
   
    public function keluar_detail($id){

        $data = Keluarbarang::keluar_detail_by_id($id);
        return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}

}
