<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WarehouseDetail;
use App\Pindah;

use DB;



class PindahController extends Controller
{
    function index()
    {

        return view('pindah_gudang.pindah_add')->with('gudangs');
    }
    public function pindah_save(Request $request)
    {

        $add = new Pindah;
        $add->warehouse_date = $request->get('warehouse_date');
        $add->warehouse_code = $request->get('warehouse_code');
        $add->status = $request->get('status');
        $add->destination = $request->get('destination');

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
        // $join = "(SELECT uid FROM warehouse_detail WHERE warehouse_id = warehouse.warehouse_id) as uid, ";


        if ($search) {

            $query = "warehouse_date '%$search%' ";
            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse WHERE $query )jumdata  FROM warehouse WHERE $query LIMIT $start,$length ");
        } else {

            $data['data'] = DB::SELECT("SELECT *,(select count(*) from warehouse)jumdata  FROM warehouse LIMIT $start,$length ");
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
    public function pindah_edit($warehouse_id)
    {
        $data['pindah'] = pindah::pindah_get_by_id($warehouse_id)[0];
        return view('pindah_gudang.pindah_edit')->with('data', $data);
    }
    public function pindah_update(Request $request)
    {

        $add = pindah::where('warehouse_id', $request->get('warehouse_id'))->firstOrFail();


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
