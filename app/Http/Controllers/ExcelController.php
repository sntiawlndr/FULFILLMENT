<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Barang;
use App\Imports\BarangImport;

class ExcelController extends Controller
{
    public function importExportView()
    {
       return view('admin_barang.barang_upload');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExcel(Request $request) 
    {
        \Excel::import(new BarangImport,$request->import_file);

        \Session::put('success', 'Your file is imported successfully in database.');
           
        
        return back();
    }
}
