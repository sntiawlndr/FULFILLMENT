@extends('layout.app')
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Pindah Gudang</h4>
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

                <select class="selectpicker mb-4 ml-3" data-style="btn btn-outline-info">
                    <option>show all </option>
                    <option>enable</option>
                    <option>Disable</option>
                </select>

                </form>
                <br>

                <!-- <span style="float:right;"><a href="{{url('/barang/filter')}}" class="btn btn-primary" style="margin-top:-10%;">Filter</a> </span>                                
                                </form>
                                <br>
                                <span style="float:right;"><a href="{{url('/barang/upload')}}" class="btn btn-primary" style="margin-top:-10%;">Import CSV</a> </span> -->
                <span style="float:right;"><a href="{{url('/pindah/add')}}" class="btn btn-primary" style="margin-top:-10%;">Tambah</a> </span>
                <br>
                <br>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-4" id="zero-config">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Id</th>
                                    <th>Gudang Tujuan</th>
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
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Gudang Detail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
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
                                    "url": "{{url('/pindah/datatable')}}",
                                    "type": "POST",
                                    "data": {
                                        '_token': $("input[name='_token']").val()
                                    }
                                },
                                "columns": [{ "data": null,"sortable": false, 
       render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
    },
                                    {
                                        data: "warehouse_date"
                                    },

                                    {
                                        data: "warehouse_code"
                                    },
                                    {
                                        data: "destination"
                                    },

                                    {
                                        data: "status"
                                    },


                                    {
                                        data: null,
                                        render: function(data, type, row) {


                                            let urledit = "{{URL::to('/')}}/pindah/edit/" + data['warehouse_id'];

                                            return '<a href="javascript:void(0)" class="btn btn-info" onclick="detail_id(' +
                                                data['warehouse_id'] + ')">Detail</a> ' +
                                                '<a href="' + urledit + '" class="btn btn-primary"/>Edit</a> ';


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
                                    "sLengthMenu": "Results :  _MENU_",
                                },
                                "stripeClasses": [],
                                "lengthMenu": [5, 10, 20, 50, 100, 500, 1000],
                                "pageLength": 5


                            });
                        }


                        function detail_id(id) {

                            $.ajax({
                                url: "{{url('/pindah/get')}}/" + id,
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
                                        body += "<tr><td>Id : <td><td>" + val.warehouse_id + "<td></tr>";
                                        body += "<tr><td>Date: <td><td>" + val.warehouse_date + "<td></tr>";
                                        body += "<tr><td>Kode: <td><td>" + val.warehouse_code + "<td></tr>";
                                        body += "<tr><td>Gudang Tujuan: <td><td>" + val.destination +
                                            "<td></tr>";
                                        body += "<tr><td>Status: <td><td>" + val.status + "<td></tr>";

                                        $(".list-detail").html(body);
                                    } else {
                                        alert("Gudang Detail Tidak Ditemukan");
                                    }
                                },
                                error: function(error) {
                                    alert("Terjadi Kesalahan");
                                }
                            });

                        }
                    </script>
                    @endpush