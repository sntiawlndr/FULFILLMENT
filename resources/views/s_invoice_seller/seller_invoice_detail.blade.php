@extends('layout.app')
@section('content')

<br>
<div id="flHorizontalForm" class="col-lg-12  col-md-6 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                            <h4>Detail 
                                            <a href="{{url('/invoice')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                            <br>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>
                                    <div class="form-group row mb-4">                            
                                            <label for="e_mail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">E-mail</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-5">
                                                <input type="email" class="form-control" id="order_email" placeholder="" name="order_email"  value="{{$order->order_email}}" required>
                                                <input type="hidden" class="form-control" id="order_id" name="order_id"  placeholder=""  value="{{$order->order_id}}">
                                                @csrf
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Nama</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-5">
                                                <input type="text" class="form-control" id="customer_name" placeholder="" name="customer_name" value="{{$order->customer_name}}">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">No.HP</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="order_telpon" placeholder="" name="order_telpon" value="{{$order->order_telpon}}">
                                            </div>
                                        </div>

                                       

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label" >Status</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="order_status" placeholder="" name="order_status" value="{{$order->order_status}}">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label" >Jumlah Tagihan</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="amount" placeholder="" name="amount" value="{{$order->amount}}">
                                                
                                            </div>
                                        </div>
                                        <div id="tabsSimple" class="col-lg-7  col md-6 col-7 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-10 col-md-6 col-sm-10 col-10">
                                            <h4>Detail</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area simple-tab">
                                    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Masuk</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Keluar</a>
                                        </li>
                                
                                    </ul>
                                    <div class="tab-content" id="simpletabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-4" id="zero-config">
                                                <thead>
                                                    <tr>
                                                        <th>Tgl Masuk</th>
                                                        <th>Nama</th>
                                                        <th>Size</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-4" id="data-config">
                                                    <thead>
                                                        <tr>
                                                            <th>Tgl Keluar</th>
                                                            <th>Nama</th>
                                                            <th>Size</th>
                                                            <th>Qty</th>
                                                            <!-- <th> Action </th> -->
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                                </form>
                                                
                                </div>
                            </div>
                        </div>
                        
                        
    @endsection('content')

    @push('jsfooter')
    <script type="text/javascript">
    
    $(document).ready(function(){
        tampil_data();
    })

    function tampil_data(){
        $('#data-config').DataTable().destroy();
        $('#data-config').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{url('/detail/data')}}",
            "type": "POST",
            "data":{'_token':$("input[name='_token']").val()}
        },
        "columns":[
    {data : "date_out"},
    {data : "product_name"},
    {data : "product_model"},
    {data : "quantity"},


       
        ],

        "oLanguage": {
            
     "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page PAGE of PAGES",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
           "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [5, 10, 20, 50,100,500,1000],
        "pageLength": 5 
        

    });
}

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
        "columns":[
    {data : "receipt_date"},
    {data : "product_name"},
    {data : "size"},
    {data : "total_qty"},


       
        ],

        "oLanguage": {
            
     "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page PAGE of PAGES",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
           "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [5, 10, 20, 50,100,500,1000],
        "pageLength": 5 
        

    });
}

    </script>
    @endpush
