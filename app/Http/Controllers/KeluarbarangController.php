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
       $join .= "(SELECT name FROM fm_users WHERE user_id = inventory_out.user_id) as name,";
       $join .= "(SELECT amount FROM fm_order WHERE order_id = inventory_out.order_id) as amount"; 
      
       if($search){   
        
        $filters = "";
        if(!empty($_POST['asal'])){
            $filters = "inventory_out.status ='".$_POST['asal']."' && ";            
           }
       
       
        $query = "$filters ((SELECT name FROM fm_users WHERE user_id = inventory_out.user_id) LIKE '%$search%'  OR status LIKE '%$search%'  OR (SELECT no_invoice FROM fm_order WHERE order_id = inventory_out.order_id) LIKE '%$search%'  OR (SELECT amount FROM fm_order WHERE order_id = inventory_out.order_id) LIKE '%$search%')";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_out WHERE $query )jumdata, $join FROM inventory_out WHERE $query LIMIT $start,$length ");
   
       }else{
           
        $filters = "";
        if(!empty($_POST['asal'])){
            $filters  = "WHERE inventory_out.status ='".$_POST['asal']."'";            
           }
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_out)jumdata, $join FROM inventory_out  $filters LIMIT $start,$length ");
        
        
    }
        
       //count total data
        
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
          // echo "SELECT *,(sel        ect count(*) from inventory_out)jumdata, $join FROM inventory_out LIMIT $start,$length";
   
          return $data;
   
       }

       public function detail_keluar_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $seller_id =$_POST['seller_id'];
        $join = "(SELECT name FROM fm_users WHERE user_id = inventory_out.user_id) as name,";
        $join .= "(SELECT product_name FROM fm_product WHERE product_id = inventory_out.product_id) as product_name,";
        $join .= "(SELECT product_sku FROM fm_product WHERE product_id= inventory_out.product_id) as product_sku ,";
        $join .= "(SELECT size FROM fm_product WHERE product_id = inventory_out.product_id) as size";
       if($search){   
       
       
        $query = "user_id ='$user_id' and ((SELECT name FROM fm_users WHERE user_id = inventory_out.user_id) LIKE '%$search%' OR (SELECT product_name FROM fm_product WHERE product_id = inventory_out.product_id) LIKE '%$search%' OR (SELECT product_sku FROM fm_product WHERE product_id= inventory_out.product_id) LIKE '%$search%' OR (SELECT size FROM fm_product WHERE product_id = inventory_out.product_id) LIKE '%$search%')";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_out WHERE $query )jumdata, $join FROM inventory_out WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_out)jumdata, $join FROM inventory_out WHERE seller_id = '$seller_id' LIMIT $start,$length ");
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
        $join = "(SELECT name FROM fm_users WHERE user_id = inventory_out.user_id) as name,";
        $join .= "(SELECT product_sku FROM fm_product WHERE product_id= inventory_out.product_id) as product_sku, ";
        $join .= "(SELECT size FROM fm_product WHERE product_id = inventory_out.product_id) as size,";
        $join .= "(SELECT amount FROM fm_order WHERE order_id = inventory_out.order_id) as amount,";
        $join .= "(SELECT location_name FROM warehouse_location WHERE location_id = inventory_out.location_id) as location_name";

       if($search){   
       
       
        $query = "(SELECT name FROM fm_users WHERE user_id = inventory_out.user_id) LIKE '%$search%' OR (SELECT product_sku FROM fm_product WHERE product_id= inventory_out.product_id) LIKE '%$search%' OR (SELECT size FROM fm_product WHERE product_id = inventory_out.product_id) LIKE '%$search%' OR product_sku LIKE '%$search%' OR (SELECT amount FROM fm_order WHERE order_id = inventory_out.order_id) LIKE '%$search%' OR product_size LIKE '%$search%' OR (SELECT location_name FROM warehouse_location WHERE location_id = inventory_out.location_id) LIKE '%$search%'";
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
        // $proses = Keluarbarang::keluar_get_by_id();
        return view('admin_keluar.keluar')->with('data',$data);
    }
    public function detail_keluar($out_id){
        $data = $out_id; //yg td diedit
        return view('admin_keluar.detail_keluar')->with('data',$data);
       
    }
    public function proses_keluar_show(){
        
        $data = [];
        // $proses = Keluarbarang::keluar_proses($out_id);
        return view('admin_keluar.keluar')->with('data',$data);
    
       
    }
    public function proses_keluar($out_id){
        
        $data['keluar']  = Keluarbarang::keluar_get_by_id($out_id)[0];
        $data['location'] = Location::location_get_by_id($data['keluar']->location_id)[0];
        $data['order'] = Order::order_get_by_id($data['keluar']->order_id)[0];  
        return view('admin_keluar.proses_keluar')->with('data',$data);

    }
    public function proses_k(Request $Request){
        
        $data = Keluarbarang::keluar_proses($Request);
        return view('admin_keluar.proses_keluar')->with('data',$data);

    }
    
    static function proses_get($Request){
        $out_id = $Request->get('foton');
        $array=array();
        $join = "(SELECT name FROM fm_users WHERE user_id = inventory_out.user_id) as name,";
        $join .= "(SELECT product_sku FROM fm_product WHERE product_id= inventory_out.product_id) as product_sku, ";
        $join .= "(SELECT size FROM fm_product WHERE product_id = inventory_out.product_id) as size,";
        $join .= "(SELECT amount FROM fm_order WHERE order_id = inventory_out.order_id) as amount,";
        $join .= "(SELECT location_name FROM warehouse_location WHERE location_id = inventory_out.location_id) as location_name";
        
        if($search){   
       
       
            $query = "(SELECT name FROM fm_users WHERE user_id = inventory_out.user_idSELECT name FROM fm_users WHERE user_id = inventory_out.user_id) LIKE '%$search%' OR product_name LIKE '%$search%' OR product_sku LIKE '%$search%' OR product_sku LIKE '%$search%' OR amount LIKE '%$search%' OR product_size LIKE '%$search%' OR location_nameLIKE '%$search%'";
            $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_out WHERE $query )jumdata, $join FROM inventory_out WHERE $query LIMIT $start,$length ");
       
           }else{
       
            $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_out)jumdata, $join FROM inventory_out LIMIT $start,$length ");
            }
           //count total data
       
            $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
            
        foreach ($out_id as $key => $value) {
            $data = DB::table("inventory_out")->where('out_id',$value)->get();
            if($data){
                array_push($array,$data[0]);  
            }       
        }
        return $array;
    }
   
    public function keluar_detail($id){

        $data = Keluarbarang::keluar_detail_by_id($id);
        return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}

}
