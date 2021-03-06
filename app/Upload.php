<?php

namespace App;
use App\Barang;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;
class Upload extends Model
{
   
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function import_data(array $row)
    {
        return new Upload([
            'product_id' => $row[1],
            'product_name' => $row[2],
            'product_sku' => $row[3], 
            'size' => $row[4],  
        ]);
    }
}
