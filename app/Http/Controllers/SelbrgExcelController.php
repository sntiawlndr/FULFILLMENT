<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sellerbarang;
use App\Imports\SelbrgImport;


class SelbrgExcelController extends Controller
{
    public function importExportSelbrg()
    {
       return view('seller_barang.selbrg_upload');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExcelSelbrg(Request $request) 
    {
        \Excel::import(new SelbrgImport,$request->import_file);

        \Session::put('success', 'Your file is imported successfully in database.');
           
        
        return back();
    }
}
