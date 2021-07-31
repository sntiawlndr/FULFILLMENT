<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pindah;


class PindahController extends Controller
{
    function index()
    {

        return view('admin_pindah.pindah_add');
    }
    public function pindah_save(Request $request)
    {


        $add = new pindah;
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

    public function pindah_datatable()
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

    public function pindah_show()
    {

        $data = Pindah::pindah_get_data_id_all();
        return view('pindah_gudang.pindah_show')->with('data', $data);
    }

    public function pindah_edit($address_id)
    {
        $data['pindah'] = pindah::pindah_get_by_id($address_id)[0];
        $data['addresses'] = Address::get_data_id_all();
        return view('pindah_gudang.pindah_edit')->with('data', $data);
    }

    public function pindah_update(Request $request)
    {

        $add = pindah::where('warehouse_id', $request->get('warehouse_id'))->firstOrFail();

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



    public function pindah_delete($id)
    {
        $delete = pindah::pindah_delete($id);
        return redirect('/pindah');
    }


    public function pindah_get($id)
    {

        $data = pindah::pindah_get_by_id($id);
        return json_encode(array('msg' => 'Sava Data Success', 'content' => $data, 'success' => TRUE));
    }
}
