@extends('layout.app')
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
    <div class="card bg-info ml-3" style="width: 20rem;">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fas fa-user-astronaut mr-2 mt-5"></i>
            </div>

            {{-- // $data = mysqli_query($koneksi,"SELECT count(*) as total from tb_pengurus");
            // while($pecah = mysqli_fetch_array($data)){
            // ?> --}}

            <b>
                <h4 class="text-center card-title">Outstanding Order
            </b></h4>
            <div class="text-center display-4 mb-3 mr-3">Total</div>
            <a href="{{url('/barang')}}" class="btn btn-primary"> Lihat Detail <i
                    class="fas fa-arrow-alt-circle-right"></i> </a>
        </div>
    </div>

    <div class="card bg-info ml-3" style="width: 20rem;">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fas fa-user-astronaut mr-2 mt-5"></i>
        </div>

        {{-- // $data = mysqli_query($koneksi,"SELECT count(*) as total from tb_pengurus");
        // while($pecah = mysqli_fetch_array($data)){
        // ?> --}}

        <b>
            <h4 class="text-center card-title">Outstanding Invoice
        </b></h4>
        <div class="text-center display-4 mb-3 mr-3">Total</div>
        <a href="{{url('/invoice')}}" class="btn btn-primary"> Lihat Detail <i
                class="fas fa-arrow-alt-circle-right"></i> </a>
    </div>
</div>

<div class="card bg-info ml-3" style="width: 20rem;">
<div class="card-body">
    <div class="card-body-icon">
        <i class="fas fa-user-astronaut mr-2 mt-5"></i>
    </div>

    {{-- // $data = mysqli_query($koneksi,"SELECT count(*) as total from tb_pengurus");
    // while($pecah = mysqli_fetch_array($data)){
    // ?> --}}

    <b>
        <h4 class="text-center card-title">Incoming Item
    </b></h4>
    <div class="text-center display-4 mb-3 mr-3">Total</div>
    <a href="{{url('/baru')}}" class="btn btn-primary"> Lihat Detail <i class="fas fa-arrow-alt-circle-right"></i> </a>
</div>
</div>
<div class="statbox widget box box-shadow">
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Latest 10 Outgoing Order</h4>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-4" id="zero-config">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Seller</th>
                        <th class="text-center" width="35%">Action</th>
                    </tr>
                </thead>
                <br>
                <br>
                <tbody>
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Latest 10 Incoming Item</h4>
                                </div>
                            </div>
                        </div>



                </tbody>
            </table>
        </div>

        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-4" id="zero-config">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Seller</th>
                            <th class="text-center" width="35%">Action</th>
                        </tr>
                    </thead>
                    <tbody>



                    </tbody>
                </table>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="detailmodal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Product Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
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


            @endsection('content');
            @push('jsfooter')
            <script type="text/javascript">
                $(document).ready(function () {
                    load_data();
                })

                // function load_data() {
                //     $('#zero-config').DataTable().destroy();
                //     $('#zero-config').DataTable({
                //         "processing": true,
                //         "serverSide": true,
                //         "ajax": {
                //             "url": "{{url('/dashboard/datatable')}}",
                //             "type": "POST",
                //             "data": {
                //                 '_token': $("input[name='_token']").val()
                //             }
                //         },
                //         "columns": [{
                //                 data: "product_id"
                //             },
                //             {
                //                 data: "product_name"
                //             },
                //             {
                //                 data: "product_description"
                //             },

                //             {
                //                 data: null,
                //                 render: function (data, type, row) {


                //                     let urledit = "{{URL::to('/')}}/product/edit/" + data['product_id'];

                //                     return '<a href="' + urledit +
                //                         '" class="btn btn-primary"/>Edit</a> ' +
                //                         '<a href="javascript:void(0)" class="btn btn-info" onclick="detail_id(' +
                //                         data['product_id'] + ')">Detail</a> ' +
                //                         "<a href='javascript:void(0)' onclick='delete_id(" + data[
                //                             'product_id'] + ")' class='btn btn-danger'>Delete</a>";

                //                 }
                //             },
                        ],

                        "oLanguage": {

                            "oPaginate": {
                                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                            },
                            "sInfo": "Showing page PAGE of PAGES",
                            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                            "sSearchPlaceholder": "Search...",
                            "sLengthMenu": "Results :  _MENU_",
                        },
                        "stripeClasses": [],
                        "lengthMenu": [5, 10, 20, 50, 100, 500, 1000],
                        "pageLength": 5


                    });
                }

                



                function delete_id(id) {
                    var ask = ("Are Sure?");
                    if (ask) {


                        $.ajax({
                            url: "{{url('/product/delete')}}/" + id,
                            method: 'GET',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                alert("Hapus Data berhasil");
                                load_data();
                            },
                            error: function (error) {
                                alert("Hapus Data Gagal");
                            }
                        });
                    }
                }

                function detail_id(id) {

                    $.ajax({
                        url: "{{url('/product/get')}}/" + id,
                        method: 'GET',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var data = JSON.parse(response);
                            var body = "";
                            if (data.content.length > 0) {
                                $('#detailmodal').modal('show');
                                val = data.content[0];
                                $(".list-detail").html(" ");
                                body += "<tr><td>ID : <td><td>" + val.product_id + "<td></tr>";
                                body += "<tr><td>Name : <td><td>" + val.product_name + "<td></tr>";
                                body += "<tr><td>Category : <td><td>" + val.product_description +
                                    "<td></tr>";

                                $(".list-detail").html(body);
                            } else {
                                alert("Product Detail Tidak Ditemukan");
                            }
                        },
                        error: function (error) {
                            alert("Terjadi Kesalahan");
                        }
                    });

                }
            </script>
            @endpush