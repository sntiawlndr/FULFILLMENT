<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class InvoiceController extends Controller
{
    function index(){
        
        return view('seller_invoice.invoice_add');
    }
    public function invoice_show(){

        $data = Order::order_get_data_id_all();
        return view('seller_invoice.invoice_show')->with('data',$data);
    }

}
