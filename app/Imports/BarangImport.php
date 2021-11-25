<?php

namespace App\Imports;

use App\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use DB;
use Auth;

HeadingRowFormatter::default('none');
class BarangImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    

    public function model(array $row)
    {

        $add = New Barang;
            $adduser=Auth::user()->user_id;
            
            return new Barang([
                'product_name'     => $row ['Nama Produk'],
                'product_model'    => $row ['SKU Induk'], 
                'product_sku'    => $row ['SKU Induk'], 
                
                'category_id' => $row['Kategori'],
                'product_description' => $row['Deskripsi Produk'],
                'seller_id' => $row = $adduser,
    
                
                 
            ]);
            $result = $add->save();
            
        
    }
}
