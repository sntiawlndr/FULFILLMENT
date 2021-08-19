<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Seller;
use App\Order;
use App\Order_detail;
use App\Terimabarangbaru;
// use App\CategoryModel;
use DB;

class TerimabarangbaruController extends Controller
{
    

    public function baru_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
       $join = "(SELECT seller_name FROM fm_seller WHERE seller_id = inventory_data.seller_id) as seller_name,";
       $join .= "(SELECT amount FROM fm_order WHERE order_id = inventory_data.order_id) as amount,"; 
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

       public function tbb_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT seller_name FROM fm_seller WHERE seller_id = inventory_data.seller_id) as seller_name";
       if($search){   
       
       
        $query = "seller_name LIKE '%$search%' OR no_invoice LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_data WHERE $query )jumdata, $join FROM inventory_data WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_data)jumdata, $join FROM inventory_data LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
        //   echo  "SELECT *,(select count(*) from inventory_data)jumdata, $join FROM inventory_data LIMIT $start,$length ";
   
          return $data;
   
     }

     public function summary_datatable(){

        $data=[];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT seller_name FROM fm_seller WHERE seller_id = inventory_data.seller_id) as seller_name,";
        $join .= "(SELECT quantity FROM fm_order_detail WHERE order_detail_id = inventory_data.order_detail_id) as quantity";
       if($search){   
       
       
        $query = "seller_name LIKE '%$search%' OR no_invoice LIKE '%$search%'";
        $data['data'] = DB::SELECT("SELECT *,(select count(*) from inventory_data WHERE $query )jumdata, $join FROM inventory_data WHERE $query LIMIT $start,$length ");
   
       }else{
   
        $data['data']= DB::SELECT("SELECT *,(select count(*) from inventory_data)jumdata, $join FROM inventory_data LIMIT $start,$length ");
        }
       //count total data
   
          $data['recordsTotal']=$data['recordsFiltered']=@$data['data'][0]->jumdata ? :0;
        //   echo  "SELECT *,(select count(*) from inventory_data)jumdata, $join FROM inventory_data LIMIT $start,$length ";
   
          return $data;
   
     }

    public function baru_show(){

        $data = Terimabarangbaru::get_data_id_all();
        return view('terima_barang_baru.baru_show')->with('data',$data);
    }
    public function tbb_show(){
        
        $data = Terimabarangbaru::tbb_data_id();      
        return view('terima_barang_baru.tbb')->with('data',$data[0]);
    }
    public function summary_show(){
        
        $data = Terimabarangbaru::summary_data_id();      
        return view('terima_barang_baru.summary')->with('data',$data[0]);
    }
    
    
   
public function baru_print($id){

$data = Terimabarangbaru::baru_print_by_id($id);
return json_encode(array('msg'=>'Save Data Success', 'content'=>$data, 'success'=>TRUE));

}

}