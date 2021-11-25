<?php

namespace App\Imports;

use App\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class ImportBarang implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function import(array $row)
    {
        return new Barang([
            'product_name' => @$row[1],
            'product_sku' => @$row[2], 
            'size' => @$row[3], 
        ]);
    }
}
