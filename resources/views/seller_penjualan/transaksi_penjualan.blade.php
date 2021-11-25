@extends('layout.app')
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                         <h4>Transaksi Penjualan</h4>
                                        </div>                 
                                    </div>
                                </div>
                                
        
                                <div class="col-lg-12 layout-spacing">
                                    <div class="statbox widget box box-shadow">
                                        <div class="widget-header">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                    <h4></h4>
                                                </div>
                                            </div>
                                        </div>
                                              
                                </form>
                                <br>                                
                                <span style="float:right;"><a href="{{url('/barang/add')}}" class="btn btn-primary mr-3" style="margin-top:-10% height:5%;">Tambah Manual</a> </span>
                                <span style="float:right;"><a href="{{url('/barang/upload')}}" class="btn btn-warning" style="margin-top:-10% height:5%;">Tambah E-Commerce  </a> </span>&nbsp
                                <br>
                                <br>
                                <br>
                                <div class="widget-content widget-content-area">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-4" id="zero-config">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Order ID</th>
                                                    <th>No Invoice</th>
                                                    <th>Status</th>
                                                    <th class="text-center" width="35%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>



                                    <!-- Modal -->
<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="detailmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                      <div class="widget-content widget-content-area">
               <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-4">
                                            <tbody class="list-detail">
                                            </tbody>
                                        </table>
                                    </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

        <!-- modal -->
        <div class="modal fade" id="cetakmodal" tabindex="-1" role="dialog" aria-labelledby="cetakmodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Print UID</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                              <div class="widget-content widget-content-area">
                       <div class="table-responsive">
                                                <table class="table table-bordered table-striped mb-4">
                                                    <tbody class="cetak-detail">
                                                    </tbody>
                                                </table>
                                            </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
          <!-- modal -->

@endsection('content');
@push('jsfooter')
<script type="text/javascript">
    $(document).ready(function() {
        load_data();
    })

    function load_data() {
        $('#zero-config').DataTable().destroy();
        $('#zero-config').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{url('/transaksi/datatable')}}",
                "type": "POST",
                "data": {
                    '_token': $("input[name='_token']").val()
                }
            },
            "columns": [ { "data": null,"sortable": false, 
       render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
    },
                {
                    data: "order_date"
                },

                {
                    data: "order_id"
                },
                {
                    data: "no_invoice"
                },
                {
                    data: "status"
                },

                {
                    data: null,
                    render: function(data, type, row) {


                        let urledit = "{{URL::to('/')}}/transaksi/edit/" + data['order_id'];

                          var btn =  '<a href="javascript:void(0)" class="btn btn-info" onclick="detail_id(' +
                            data['order_id'] + ')">Detail</a> ' ;
                              if (data['status']=='unprocessed'){
                               btn = btn+ '<a href="' + urledit + '" onclick="tanpaedit_id('+data["order_id"]+')" "/></a> ';
                            }else{
                                 btn = btn+ '<a href="' + urledit + '" onclick="edit_id('+data["order_id"]+')" class="btn btn-primary"/> Edit</a> '
                             }

                                return btn;
                    }
                },
            ],

            "oLanguage": {

                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page PAGE of PAGES",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  MENU",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50, 100, 500, 1000],
            "pageLength": 5


        });
    }
function edit_id(id){

if(ask){


$.ajax({
url:"{{url('transaksi/ubah')}}/"+id,
method: 'GET',
cache: false,
contentType: false,
processData: false,
success: function(response) {
alert("edit Data berhasil");
load_data();
},error: function (error) {
 alert("edit Data Gagal");          
}
});
}
}
function tanpaedit_id(id){

if(ask){


$.ajax({
url:"{{url('/transaksi/tanpaedit')}}/"+id,
method: 'GET',
cache: false,
contentType: false,
processData: false,
success: function(response) {
alert("ttanpa edit Data berhasil");
load_data();
},error: function (error) {
 alert("tanpa edit Data Gagal");          
}
});
}
}



   

    function detail_id(id) {

        $.ajax({
            url: "{{url('/transaksi/get')}}/" + id,
            method: 'GET',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var data = JSON.parse(response);
                var body = "";
                if (data.content.length > 0) {
                    $('#detailmodal').modal('show');
                    val = data.content[0];
                    $(".list-detail").html(" ");
                    body += "<tr><td>Order Date: <td><td>" + val.order_date + "<td></tr>";
                    body += "<tr><td>Order ID: <td><td>" + val.order_id + "<td></tr>";
                    body += "<tr><td>No Invoice: <td><td>" + val.no_invoice +
                        "<td></tr>";
                    $(".list-detail").html(body);
                } else {
                    alert(" Detail Tidak Ditemukan");
                }
            },
            error: function(error) {
                alert("Terjadi Kesalahan");
            }
        });

    }
</script>
@endpush