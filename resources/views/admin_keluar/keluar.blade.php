@extends('layout.app')

@section('content')
<div style = "display:none" id="tableStriped1" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                         <h4>Proses Keluar Barang</h4>
                                        </div>                 
                                    </div>
                                </div>
                                                                                                  
                             
                                <br>
                                <div class="widget-content widget-content-area">
                                    <div class="table-responsive">
                                        <table class="table table-striped1 mb-4">
                                            <thead>
                                                <tr>     
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>SKU</th>
                                                    <th>Ukuran</th>
                                                    <th>Jumlah</th>
                                                    <th>Lokasi</th>
                                                 

                                                </tr>
                                                
                                            </thead>
                                            {{-- <tbody>                                                
                                                    @foreach ($proses as $item)
                                                        
                                                    <tr>
                                                    <td><input type="text" value="{{$item->product_id}}"></td>                               
                                                    <td><input type="text" value="{{$item->product_name}}"></td>
                                                    <td><input type="text" value="{{$item->product_sku}}"></td>
                                                    <td><input type="text" value="{{$item->size}}"></td>
                                                    <td><input type="text" value="{{$item->amount}}"></td>
                                                    <td><input type="text" value="{{$item->location_name}}"></td>
                                                    </tr>
                                                    @endforeach
                                            </tbody> --}}
                                        </table>
                                        <input type="hidden" class="form-control" id="checkk" value="">
                                        <div class="form-group row">
                                            <button href = "{{url('/')}}" type="button" class="btn btn-primary" data-dismiss="modal">Proses</button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                           
</div>

<div id="tableCheckbox" class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Daftar Keluar Barang</h4>
                </div>
            </div>
        </div>
        <form>
            <br>
            <br>
            <div class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    {{-- <button type="button" style="float:right" onclick="process_id()" class="btn btn-primary chk"
                        style="margin-top:-10%;" id="checkk">Process</button> --}}
                    <a href = "javascript:void(0)" style="float:right" onclick ="process_id()" class="btn btn-primary chk"
                        style="margin-top:-10%;" id="checkk">Process</a>

                    <span style="float: right;">
                        <select id="filt" class="form-control" style="width: 200px">
                            <option value="">--Filter Status(All, Penjualan, dst.)--</option>
                            <option value="penjualan">Penjualan</option>
                            <option value="pindah gudang">Pindah Gudang</option>
                            <option value="pinjam">Pinjam</option>
                        </select>
                    </span>
                    <br>
                    <br>
                    <br>

        </form>



        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4"
                    id="zero-config">
                    <thead>
                        <tr>
                            <th class="checkbox-column">
                                <label class="new-control new-checkbox checkbox-primary"
                                    style="height: 18px; margin: 0 auto;">
                                    <input type="checkbox" class="new-control-input chk" id="todoAll">
                                    <span class="new-control-indicator"></span>
                                </label>
                            </th>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Seller</th>
                            <th>Total Jumlah</th>
                            <th>Status</th>
                            <th class="text-center" width="35%">Action</th>
                        </tr>
                    </thead>
                   
                </table>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="detailmodal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Keluar Barang Detail</h5>
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
        $("#todoAll").on('click', function () {
            var isChecked = $("#todoAll").prop('checked')
            $(".chk").prop('checked', isChecked)
        })

        $("#zero-config tbody").on('click', '.chk', function () {
            if ($(this).prop('checked') != true) {
                $("#todoAll").prop('checked', false)

            }
        })

        $('#filt').change(function () {
            var asal = $(this).val()
            if (asal !== "") {
                load_data();
            }

        })

        $(document).ready(function () {
            load_data();
        })


        function load_data() {
            $('#zero-config').DataTable().destroy();
            $('#zero-config').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{url('/keluar/datatable')}}",
                    "type": "POST",
                    "data": {
                        '_token': $("input[name='_token']").val(),
                        'asal': $('#filt :selected').val()
                    }
                },
                "columns": [{
                        data: null,
                        render: function (data, type, row) {
                            return ' <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;"><input type="checkbox" class="new-control-input chk" name="listout_id[]" value="' +
                                data["out_id"] +
                                '" id="todoAll"><span class="new-control-indicator"></span></label>';
                        }
                    },
                    {
                        "data": null,
                        "sortable": false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "no_invoice"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "amount"
                    },
                    {
                        data: "status"
                    },

                    {
                        data: null,
                        render: function (data, type, row) {

                            let urldetail = "{{URL::to('/')}}/detail/keluar/" + data['seller_id'];

                            return '<a href="' + urldetail + '" class="btn btn-info"/>Detail</a> ';
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


        function delete_id(id) {
            var ask = ("Are Sure?");
            if (ask) {


                $.ajax({
                    url: "{{url('/seller/delete')}}/" + id,
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
                url: "{{url('/keluar/get')}}/" + id,
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
                        body += "<tr><td>No Transaksi : <td><td>" + val.no_invoice + "<td></tr>";
                        body += "<tr><td>Nama Seller: <td><td>" + val.seller_name + "<td></tr>";
                        body += "<tr><td>Total Jumlah: <td><td>" + val.amount + "<td></tr>";
                        body += "<tr><td>Status: <td><td>" + val.location_status + "<td></tr>";
                        $(".list-detail").html(body);
                    } else {
                        alert("Detail Tidak Ditemukan");
                    }
                },
                error: function (error) {
                    alert("Terjadi Kesalahan");
                }
            });


        }

        function process_id() {

            let checkbox_terpilih = $(".chk:checked")
            let semua_id = []
            $.each(checkbox_terpilih, function (index, elm) {
                semua_id.push(elm.value)
            })
            console.log(semua_id)
            

            $.ajax({

                method: 'POST',
                url: "{{url('/proses/keluar')}}",
                data: {'_token': $("input[name='_token']").val(),
                    foton: semua_id
                },
                
                success: function (data) {
                    $('#tableCheckbox').css({'display':'none'});
                    $('#tableStriped1').css({'display':'block'});
                    var data = JSON.parse(response);
                    var body = "";
                    if (data.content.length > 0) {
                        $('#tableStriped1').modal('show');
                        val = data.content[0];
                        $(".table-striped1").html(" ");
                        body += "<tr><td>No : <td><td>" + val.product_id + "<td></tr>";
                        body += "<tr><td>Nama Barang: <td><td>" + val.product_name + "<td></tr>";
                        body += "<tr><td>SKU: <td><td>" + val.product_sku + "<td></tr>";
                        body += "<tr><td>Ukuran: <td><td>" + val.size + "<td></tr>";
                        body += "<tr><td>Jumlah: <td><td>" + val.amount + "<td></tr>";
                        body += "<tr><td>Lokasi: <td><td>" + val.location + "<td></tr>";

                        $(".table-striped1").html(body);
                    } else {
                        alert("Detail Tidak Ditemukan");
                    }
                
                  
                }
            });
        }
    </script>
    @endpush