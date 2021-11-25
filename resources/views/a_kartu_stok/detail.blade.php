@extends('layout.app')
@section('content')

<br>
<div id="flHorizontalForm" class="col-lg-12  col-md-6 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                            <h4>Detail Kartu Stok
                                            <a href="{{url('kartu')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                            <br>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>
                                    <div class="form-group row mb-4">                            
                                            <label for="e_mail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Seller</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-5">
                                                 <input type="text" class="form-control" id="seller_name" placeholder="" name="seller_name" readonly="" value="{{$data['seller']->seller_name}}">
                                                 <input type="hidden" class="form-control" name="seller_id" id="seller_id" placeholder="" value="{{$data['kartu']->seller_id}}">
                                                @csrf
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Nama Barang</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-5">
                                               <input type="text" class="form-control" id="product_name" placeholder="" name="product_name" readonly="" value="{{$data['kartu']->product_name}}">
                                                 <input type="hidden" class="form-control" name="inventory_id" id="inventory_id" placeholder="" value="{{$data['kartu']->inventory_id}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Quantity saat ini</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="order_detail_id" placeholder="" name="order_detail_id" readonly="" value="{{$data['orderdetail']->quantity}}">
                                                 <input type="hidden" class="form-control" id="order_detail_id" placeholder="" name="order_detail_id" value="{{$data['orderdetail']->order_detail_id}}">
                                            </div>
                                        </div>
                
                                        </div>
                                        <br>
 <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-4" id="zero-config">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                        </table>
                                    

  @endsection('content')

    @push('jsfooter')
    <script type="text/javascript">
$(document).ready(function(){
    load_data();
})

function load_data(){
    $('#zero-config').DataTable().destroy();
    $('#zero-config').DataTable( {
     "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "{{url('/detail/datatable')}}",
        "type": "POST",
        "data":{'_token':$("input[name='_token']").val()}
    },
     "columns": [{ "data": null,"sortable": false, 
       render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
    },

{data : "receipt_date"},
{data : "receipt_qty"},
{data : "product_id"},  
{data : "total_qty"},


{ data: null, render: function ( data, type, row ) {

 return '<a href="{{url('edit')}}" class="btn btn-primary"/>Detail</a> ';
       } },         
        ],

        "oLanguage": {
            
     "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page PAGE of PAGES",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
           "sLengthMenu": "Results :  MENU",
        },
        "stripeClasses": [],
        "lengthMenu": [5, 10, 20, 50,100,500,1000],
        "pageLength": 5 
        

    });
}
    </script>
    @endpush