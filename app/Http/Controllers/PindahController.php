<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pindah;
use App\Seller;
use App\Barang;
use App\Detail;

use DB;



class PindahController extends Controller
{
    function index()
    {
        $data['sellers']= Seller::get_data_id_all(); //yg td diedit
        $data['pindahs']= Pindah::pindah_get_data_id_all();//yg td diedit
        $data['products']= Barang::get_data_id_all();//yg td diedit
        return view('pindah_gudang.pindah_add')->with('data',$data);
    }
    public function pindah_save(Request $request)
    {

        $add = new Detail;
        $add->warehouse_id = $request->get('warehouse_id');
        $add->seller_id = $request->get('seller_id');
        $add->product_id= $request->get('product_id');
        $add->quantity = $request->get('quantity');

        $result = $add->save();

        if ($result) {
            return json_encode(array('msg' => 'Simpan Data Berhasil', 'content' => $result, 'success' => TRUE));
        } else {
            return json_encode(array('msg' => 'Gagal Menyimpan Data', 'content' => $result, 'success' => FALSE));
        }
    }

    //  public function pindah_tampil (Request $request)
    // {

    //     $add = new Pindah;
    //     $add->seller_id = $request->get('seller_id');
    //     $add->warehouse_detail_id = $request->get('warehouse_detail_id');
    //     $add->seller_name= $request->get('seller_name');
    //     $add->product_name = $request->get('product_name');
    //     $add->product_model = $request->get('product_model');
    //     $add->quantity $request->get('quantity');

    //     $result = $add->save();

    //     if ($result) {
    //         return json_encode(array('msg' => 'Simpan Data Berhasil', 'content' => $result, 'success' => TRUE));
    //     } else {
    //         return json_encode(array('msg' => 'Gagal Menyimpan Data', 'content' => $result, 'success' => FALSE));
    //     }
    // }

    public function pindah_datatable()
    {

        $data = [];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];


        if ($search) {

         $query = "warehouse_date LIKE '%$search%' OR warehouse_code LIKE '%$search%'  OR destination LIKE '%$search%' OR status LIKE '%$search%'";
            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse WHERE $query )jumdata FROM warehouse WHERE $query LIMIT $start,$length ");
        } else {

            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse)jumdata FROM warehouse LIMIT $start,$length ");
        }
        //count total data

        $data['recordsTotal'] = $data['recordsFiltered'] = @$data['data'][0]->jumdata ?: 0;


        return $data;
    }

   public function tampil_datatable()
    {

        $data = [];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT seller_name FROM fm_seller WHERE seller_id = warehouse_detail.seller_id) as seller_name,";
        $join .= "(SELECT product_sku FROM fm_product WHERE product_id= warehouse_detail.product_id) as product_sku";
        
 


        if ($search) {

            $query = "seller_name LIKE '%$search%' OR warehouse_id LIKE '%$search%'  OR product_name LIKE '%$search%'  OR product_model LIKE '%$search%'";
            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse_detail WHERE $query )jumdata, $join FROM warehouse_detail WHERE $query LIMIT $start,$length ");
        } else {

            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse_detail)jumdata, $join FROM warehouse_detail LIMIT $start,$length ");
        }
        //count total data

        $data['recordsTotal'] = $data['recordsFiltered'] = @$data['data'][0]->jumdata ?: 0;


        return $data;
    }


    public function pindah_show()
    {

        $data = Pindah::pindah_get_data_id_all();
        return view('pindah_gudang.pindah_show')->with('data', $data);
    }


 // public function tampil_show()
 //    {

 //        $data = Pindah::tampil_get_data_id_all();
 //        return view('pindah_gudang.pindah_add')->with('data', $data);
 //    }




    public function pindah_edit($warehouse_id)
    {
        $data['pindah'] = Pindah::pindah_get_by_id($warehouse_id)[0];
        return view('pindah_gudang.pindah_edit')->with('data', $data);
    }
   

    public function pindah_update(Request $request)
    {
        $add = Pindah::where('warehouse_id', $request->get('warehouse_id'))->firstOrFail();
        $add->warehouse_date = $request->get('warehouse_date');
        $add->warehouse_code = $request->get('warehouse_code');
        $add->destination = $request->get('destination');
        $add->status = $request->get('status');
        $result = $add->save();


        if ($result) {
            return json_encode(array('msg' => 'Simpan Data Berhasil', 'content' => $result, 'success' => TRUE));
        } else {
            return json_encode(array('msg' => 'Gagal Menyimpan Data', 'content' => $result, 'success' => FALSE));
        }
    }



    public function pindah_get($id)
    {

        $data = pindah::pindah_get_by_id($id);
        return json_encode(array('msg' => 'Sava Data Success', 'content' => $data, 'success' => TRUE));
    }
}
