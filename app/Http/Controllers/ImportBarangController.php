<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Imports\ImportBarang;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use DB;
class ImportBarangController extends Controller
{
    public function index()
    {
        $data = Barang::orderBy('created_at','DESC')->get();
        return view('admin_barang.upload',compact('data'));
    }
 
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
        Excel::import(new ImportBarang, request()->file('import_file'));
        return back()->with('success', 'Contacts imported successfully.');
    }   
}
