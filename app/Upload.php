<?php

namespace App;
use App\Barang;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class Upload extends Model
{
   
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Upload([
            'product_id' => $row[1],
            'product_name' => $row[2],
            'product_sku' => $row[3], 
            'size' => $row[4],  
        ]);
    }
}
