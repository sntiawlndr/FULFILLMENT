<?php

namespace App\Imports;

use App\Sellerbarang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //pake heading
use Maatwebsite\Excel\Imports\HeadingRowFormatter; //spasi
use DB;

HeadingRowFormatter::default('none'); //format heading
class SelbrgImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sellerbarang([
            'product_name'     => $row ['Nama Produk'],
            'product_model'    => $row ['SKU Induk'], 
            'product_sku'    => $row ['SKU Induk'], 
            
            'category_id' => $row['Kategori'],
            'product_description' => $row['Deskripsi Produk'],
            // 'user_id' => $row = $adduser,
        ]);
    }
}
