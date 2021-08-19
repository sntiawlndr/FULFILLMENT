@extends('layout.app')
@section('content')

<br>
                            <div id="tabsSimple" class="col-lg-7  col md-6 col-7 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-10 col-md-6 col-sm-10 col-10">
                                            <h4>Terima Barang Baru
                                                <a href="{{url('/baru')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area simple-tab">
                                    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Summary</a>
                                        </li>
                                
                                    </ul>
                                    <div class="tab-content" id="simpletabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-4" id="zero-config">
                                                <thead>
                                                    <tr>
                                                        <th>UID</th>
                                                        <th>Seller Name</th>
                                                        <th class="text-center" width="35%">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-4" id="a-config">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Quantity</th>  
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
     $("#saveButton").click(function () {

formData = {
    'uid': $("#uid").val(),
    'seller_name': $("#seller_name").val(),
    '_token': $("input[name='_token']").val()
}


$.ajax({
    url: "{{url('/tbb/save')}}",
    method: 'POST',
    data: formData,
    cache: false,
    success: function (response) {
        response = JSON.parse(response);
        if (response.success == true) {
            alert('Simpan Data Berhasil');
            location.reload();
        } else {
            alert("Gagal Menyimpan Data");
        }
    },
    error: function (error) {
        alert("Terjadi Kesalahan");
    }
});
});


   
$(document).ready(function(){
    load_data();
})

function load_data(){
    $('#zero-config').DataTable().destroy();
    $('#zero-config').DataTable( {
     "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "{{url('/tbb/datatable')}}",
        "type": "POST",
        "data":{'_token':$("input[name='_token']").val()}
    },
     "columns":[

// {data : "order_id"},
{data : "uid"},
{data : "seller_name"},
{ data: null, render: function ( data, type, row ) {



return '<a href="{{url('baru')}}" class="btn btn-primary"/>Batal</a> ';  
   } },
     
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
    tampil_data();
})

function tampil_data(){
    $('#a-config').DataTable().destroy();
    $('#a-config').DataTable( {
     "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "{{url('/summary/datatable')}}",
        "type": "POST",
        "data":{'_token':$("input[name='_token']").val()}
    },
     "columns":[

// {data : "order_id"},
{data : "seller_name"},
{data : "quantity"},
// { data: null, render: function ( data, type, row ) {



// return '<a href="{{url('baru')}}" class="btn btn-primary"/>Batal</a> ';  
//        } },
     
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
