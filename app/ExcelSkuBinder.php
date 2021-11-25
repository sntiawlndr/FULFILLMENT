<?php

namespace App;

use PHPExcel_Cell;
use PHPExcel_Cell_DataType;
use PHPExcel_Cell_IValueBinder;
use PHPExcel_Cell_DefaultValueBinder;

class ExcelSkuBinder extends PHPExcel_Cell_DefaultValueBinder implements PHPExcel_Cell_IValueBinder
{
    public function bindValue(PHPExcel_Cell $cell, $value = null)
    {
        // Cast values ending with 'e-1' to string
        if (ends_with($value, 'e-1')) {
            $cell->setValueExplicit($value, PHPExcel_Cell_DataType::TYPE_STRING);
            return true;
        }

        // Use default binding for all other values
        return parent::bindValue($cell, $value);
    }
}