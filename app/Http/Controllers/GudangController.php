<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gudang;
use App\Address;

use DB;

class GudangController extends Controller
{
    function index()
    {

        return view('admin_gudang.gudang_add');
    }
    public function gudang_save(Request $request)
    {


        $add = new Gudang;
        $add->warehouse_name = $request->get('warehouse_name');
        $add->warehouse_code = $request->get('warehouse_code');
        $add->address_telepon = $request->get('address_telepon');
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
        $join = "(SELECT address FROM fm_address WHERE address_id = warehouse.address_id) as address,";
        $join .= "(SELECT address_telepon FROM fm_address WHERE address_id = warehouse.address_id) as address_telepon ";

        if ($search) {

            $query = "warehouse_name LIKE '%$search%' OR warehouse_id LIKE '%$search%'  OR address_telepon LIKE '%$search%'  OR warehouse_status LIKE '%$search%'";
            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse WHERE $query )jumdata, $join FROM warehouse WHERE $query LIMIT $start,$length ");
        } else {

            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse)jumdata, $join FROM warehouse LIMIT $start,$length ");
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

    public function gudang_edit($address_id)
    {
        $data['gudang'] = Gudang::gudang_get_by_id($address_id)[0];
        $data['addresses'] = Address::get_data_id_all();
        return view('admin_gudang.gudang_edit')->with('data', $data);
    }

    public function gudang_update(Request $request)
    {

        $add = Gudang::where('warehouse_id', $request->get('warehouse_id'))->firstOrFail();

        $add->warehouse_name = $request->get('warehouse_name');
        $add->warehouse_name = $request->get('warehouse_code');
        $add->address_id = $request->get('address_id');
        $result = $add->save();

        if ($result) {
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

        $data = Gudang::gudang_get_by_id($id);
        return json_encode(array('msg' => 'Sava Data Success', 'content' => $data, 'success' => TRUE));
    }
}
