<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gudang;
use App\Address;
use App\CitiesModel;
use App\ProvincesModel;

use DB;

class GudangController extends Controller
{
    function index()
    {

        $data['gudangs']= Gudang::get_data_id_all();
        $data['addresses']= Address::get_data_id_all();
        $data['cities']= CitiesModel::get_data_id_all();
        $data['provinces']= ProvincesModel::get_data_id_all();
        return view('admin_gudang.gudang_add')->with('data',$data);
    }
    public function gudang_save(Request $request)
    {


        $add = new Gudang;
        $add->location_name = $request->get('location_name');
        $add->location_code = $request->get('location_code');
        $add->address_id = $request->get('address_id');
        $add->warehouse_status = $request->get('warehouse_status');

        $result = $add->save();

        if ($result) {
            return json_encode(array('msg' => 'Simpan Data Berhasil', 'content' => $result, 'success' => TRUE));
        } else {
            return json_encode(array('msg' => 'Gagal Menyimpan Data', 'content' => $result, 'success' => FALSE));
        }
    }

    public function gudang_datatable()
    {

        $data = [];
        $length = $_POST['length'];
        $start = $_POST['start'];
        $search = $_POST['search']['value'];
        $join = "(SELECT address FROM fm_address WHERE address_id = warehouse_location.address_id) as address,";
        $join .= "(SELECT address_telepon FROM fm_address WHERE address_id = warehouse_location.address_id) as address_telepon ";

        if ($search) {

            $query = "location_name LIKE '%$search%' OR location_code LIKE '%$search%' ";
            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse_location WHERE $query )jumdata, $join FROM warehouse_location WHERE $query LIMIT $start,$length ");
        } else {

            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse)jumdata, $join FROM warehouse_location LIMIT $start,$length ");
        }
        //count total data

        $data['recordsTotal'] = $data['recordsFiltered'] = @$data['data'][0]->jumdata ?: 0;


        return $data;
    }

    public function gudang_show()
    {

        $data = Gudang::get_data_id_all();
        return view('admin_gudang.gudang_show')->with('data', $data);
    }

    public function gudang_edit($location_id)
    {
        $data['gudang'] = Gudang::gudang_get_by_id($location_id)[0];
        $data['address'] = Address::address_get_by_id($data['gudang']->address_id)[0];

        return view('admin_gudang.gudang_edit')->with('data', $data);
    }

    public function gudang_update(Request $request)
    {

        $add = Gudang::where('location_id', $request->get('location_id'))->firstOrFail();
        $ads = Address::where('address_id', $request->get('address_id'))->firstOrFail();


        $add->location_name = $request->get('location_name');
        $add->location_code = $request->get('location_code');
        $add->address_id = $request->get('address_id');
        $ads->address = $request->get('address');
        $ads->address_telepon = $request->get('address_telepon');
        $result = $add->save();
        $resultads = $ads->save();

        if ($result && $resultads) {
            return json_encode(array('msg' => 'Simpan Data Berhasil', 'content' => $result, 'success' => TRUE));
        } else {
            return json_encode(array('msg' => 'Gagal Menyimpan Data', 'content' => $result, 'success' => FALSE));
        }
    }



    public function gudang_delete($id)
    {
        $delete = Gudang::gudang_delete($id);
        return redirect('/gudang');
    }


    public function gudang_get($id)
    {

        // $data = Gudang::gudang_get_by_id($id);
        $join = "(SELECT address FROM fm_address WHERE address_id = warehouse_location.address_id) as address,";
        $join .= "(SELECT address_telepon FROM fm_address WHERE address_id = warehouse_location.address_id) as address_telepon ";
        $data = DB::SELECT("SELECT *, $join FROM warehouse_location WHERE location_id= $id ");
        return json_encode(array('msg' => 'Sava Data Success', 'content' => $data, 'success' => TRUE));
    }

    public function get_kecamatan(){
        $provinsi=$_POST['provinsi'];
        $data = DB::SELECT("SELECT * FROM cn_zone WHERE country_id= $provinsi ");
        return json_encode(array('msg' => 'Sava Data Success', 'content' => $data, 'success' => TRUE));
    }
}
