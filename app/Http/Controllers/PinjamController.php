<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InvBorrowModel;
use App\Address;
use App\CitiesModel;
use App\ProvincesModel;
use App\Districts;
use App\Barang;
use App\InvBorDelModel;
use App\Order;
use App\Order_detail;
use App\CnCountryModel;
use DB;
use Auth;
class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['invenborrows']= Order::order_get_data_id_all();
        $data['invbordels']= Order_detail::orderdetail_get_data_id_all();
        $data['addresses']= Address::get_data_id_all();
        $data['cities']= CitiesModel::get_data_id_all();
        $data['provinces']= ProvincesModel::get_data_id_all();
        $user_id=Auth::user()->user_id;
        $databrg= Barang::barang_get_by_user_id($user_id);
        
        // $databrg = DB::table('fm_product')->where('user_id')->get($user_id);
        
        return view('s_pinjam.pinjam_add')->with('data',$data)->with('products',$databrg);
    }

    // public function category_edit($category_id){
    //     $categories = CategoryModel::get_data_id_all();
    //     $data = CategoryModel::category_get_by_id($category_id);
        
    //     return view('category.category_edit')->with('category',$data[0])->with('categories',$categories);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pinjam_datatable(){
        $data = [];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $user_id=Auth::user()->user_id;
        $join = "(SELECT order_date FROM fm_order WHERE order_id = fm_order_detail.order_id) as order_date";
        
        if ($search) {

            $query = " user_id ='$user_id' and(order_id LIKE '%$search%')";
            $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order_detail WHERE $query )jumdata,$join FROM fm_order_detail WHERE $query LIMIT $start,$length ");
        } else {

            $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order_detail)jumdata,$join FROM fm_order_detail WHERE user_id=$user_id LIMIT  $start,$length ");
        }
        //count total data

        $data['recordsTotal'] = $data['recordsFiltered'] = @$data['data'][0]->jumdata ?: 0;


        return $data;
       }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pinjam_show()
    {
        $user_id=Auth::user()->user_id;
        $data = Order::  invbor_get_by_userid($user_id);
        return view('s_pinjam.pinjam_show')->with('pinjam',$data[0]);
    }

    public function pinjam_save(Request $request)
    {

        
        
        $adf = new Address;
        $adf->address = $request->get('address');
        $adf->country_id = $request->get('address_prov');
        $adf->address_city = $request->get('address_city');
        $adf->address_districts = $request->get('address_kec');
        $adf->address_postal_code = $request->get('postal_code');
        $addres = $adf->save();
        if($addres){
            $add = new Order;
            $add->address_id = $adf->address_id;
            $add->customer_name = $request->get('borrow_name');
            $add->order_telpon = $request->get('borrow_telepon');
            $add->order_delivery = $request->get('pengiriman');
            $add->note = $request->get('notes');
            $add->type = $request->get('type') == 'pinjam';
            // $pid = InvBorrowModel::generatePinjamId();
            // $add->borrow_invoice_id = ($pid);
            $add->no_invoice = $request->get('borrow_invoice_id');
            $current_date_time = date('Y-m-d H:i:s');
            $add->order_date = ($current_date_time);
            $adduser=Auth::user()->user_id;
            $add->user_id = ($adduser);
            $addusermail=Auth::user()->email;
            $add->order_email = ($addusermail);
            $result = $add->save();
        }

       if($result){
        if(!empty($request->get('list_product_id'))){
            $product_id = $request->get('list_product_id');
             for ($i=0; $i < count($product_id); $i++) { 
           $abd = new Order_detail;
           $abd->order_id = $add->order_id;
           $abd->product_id = $request->get('list_product_id')[$i];
           $abd->product_name = $request->get('list_product_name')[$i];
           $abd->product_sku = $request->get('list_product_sku')[$i];
           $abd->product_model = $request->get('list_product_model')[$i];
           $abd->quantity = $request->get('list_quantity')[$i];
        //    $abd->uid = $request->get('uid')[$i];
           $abd->uid = Order_detail::generateRandomUID();
           $abd->user_id = $add->user_id;
           $bordel = $abd->save();
             }
            }
            
       }
       

        if ($result && $addres && $bordel) {
            return json_encode(array('msg' => 'Simpan Data Berhasil', 'content' => $result, 'success' => TRUE));
        } else {
            return json_encode(array('msg' => 'Gagal Menyimpan Data', 'content' => $result, 'success' => FALSE));
        }
    }

    public function pinjam_detail($order_detail_id){
        $data['ordels'] =  Order_detail::orderdetail_get_by_id($order_detail_id)[0];
        $data['orders'] = Order::order_by_order_id($data['ordels']->order_id)[0];  //yg td diedit
        $data['address'] = Address::address_get_by_id($data['orders']->address_id)[0];
        return view('s_pinjam.pinjam_detail')->with('data',$data);
        
        
    }
    public function detail_pinjam_datatable(){
        $data = [];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $order_detail_id =$_POST['order_detail_id'];
        
        
        if ($search) {

            $query = " order_detail_id ='$order_detail_id'";
            $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order_detail WHERE $query )jumdata,$join FROM fm_order_detail WHERE $query LIMIT $start,$length ");
        } else {

            $data['data'] = DB::SELECT("SELECT *,(select count(*) from fm_order_detail)jumdata,$join FROM fm_order_detail WHERE user_id=$user_id LIMIT  $start,$length ");
        }
        //count total data

        $data['recordsTotal'] = $data['recordsFiltered'] = @$data['data'][0]->jumdata ?: 0;


        return $data;
       }

       public function pinjam_edit($order_id){
        
        $data['orders'] = Order::order_by_order_id($order_id)[0];
        $data['ordels'] = Order_detail::orderdetail_get_by_order_id($order_id);  
        $data['address'] = Address::address_get_by_id($data['orders']->address_id)[0];
        
       
        $data['countrys']= CnCountryModel::country_get_by_id($data['address']->country_id)[0];
        $data['provinces']= ProvincesModel::get_data_id_all();
        $data['cities']= CitiesModel::get_data_id_all();
        $data['districts']= Districts::get_data_id_all();
        $user_id=Auth::user()->user_id;
        $databrg= Barang::barang_get_by_user_id($user_id);
     
        return view('s_pinjam.pinjam_edit')->with('data',$data)->with('products',$databrg);
    }

    public function pinjam_update(Request $request){

 
        $add = Order::where('order_id',$request->get('order_id'))->firstOrFail();
        $adf = Address::where('address_id', $request->get('address_id'))->firstOrFail();
        $abd = Order_detail::where('order_detail_id',$request->get('order_detail_id'))->firstOrFail();

        
        $adf->address = $request->get('address');
        $adf->country_id = $request->get('address_prov');
        $adf->address_city = $request->get('address_city');
        $adf->address_districts = $request->get('address_kec');
        $adf->address_postal_code = $request->get('postal_code');
        $addres = $adf->save();
        if($addres){
            
            $add->address_id = $request->get('address_id');
            $add->customer_name = $request->get('borrow_name');
            $add->order_telpon = $request->get('borrow_telepon');
            $add->order_delivery = $request->get('pengiriman');
            $add->note = $request->get('notes');
            $add->type = $request->get('type') == 'pinjam';
            // $pid = InvBorrowModel::generatePinjamId();
            // $add->borrow_invoice_id = ($pid);
            $add->no_invoice = $request->get('borrow_invoice_id');
            $current_date_time = date('Y-m-d H:i:s');
            $add->order_date = ($current_date_time);
            $adduser=Auth::user()->user_id;
            $add->user_id = ($adduser);
            $addusermail=Auth::user()->email;
            $add->order_email = ($addusermail);
            $result = $add->save();
        }

       if($result){
        if(!empty($request->get('list_product_id'))){
            $product_id = $request->get('list_product_id');
             for ($i=0; $i < count($product_id); $i++) { 
           $abd = new Order_detail;
           $abd->order_id = $add->order_id;
           $abd->product_id = $request->get('list_product_id')[$i];
           $abd->product_name = $request->get('list_product_name')[$i];
           $abd->product_sku = $request->get('list_product_sku')[$i];
           $abd->product_model = $request->get('list_product_model')[$i];
           $abd->quantity = $request->get('list_quantity')[$i];
           $abd->user_id = $add->user_id;
           $bordel = $abd->save();
             }
            }
            
       }
       

        if ($result && $addres && $bordel) {
            return json_encode(array('msg' => 'Simpan Data Berhasil', 'content' => $result, 'success' => TRUE));
        } else {
            return json_encode(array('msg' => 'Gagal Menyimpan Data', 'content' => $result, 'success' => FALSE));
        }
        
    }
    



}
