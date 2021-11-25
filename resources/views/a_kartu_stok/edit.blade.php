@extends('layout.app')
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Detail Perpindahan Barang</h4>
                </div>
            </div>
        </div>

        <div class="widget-content widget-content-area">
                                    <div class="scroll" id="scroll">                                   
                                    <div class="form-group row mb-4">
                                        <label for="hNomorPenerimaan" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Tanggal</label>
                                        {{-- @foreach ($data['tbbs'] as $tbb) --}}
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text" class = "form-control" name="no_invoice" autocomplete="off" readonly= "" 
                                                id="no_invoice" >
                                        </div>
                                        {{-- value="{{$tbb->no_invoice}}" --}}
                                        {{-- @endforeach --}}
                                        
                                    </div>
                <br>

                <!-- <span style="float:right;"><a href="{{url('/barang/filter')}}" class="btn btn-primary" style="margin-top:-10%;">Filter</a> </span>                                
                                </form>
                                <br>
                                <span style="float:right;"><a href="{{url('/barang/upload')}}" class="btn btn-primary" style="margin-top:-10%;">Import CSV</a> </span> -->
               
                <br>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-4" id="zero-config">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>UID</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                        </table>
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
                                    "url": "{{url('/edit/datatable')}}",
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
                                        data: "uid"
                                    },

                                    {
                                        data: "inventory_status"
                                    },
                                    
                                   
                                ],

                                


                            });
                        }


                        // function detail_id(id) {

                        //     $.ajax({
                        //         url: "{{url('/kartu/get')}}/" + id,
                        //         method: 'GET',
                        //         cache: false,
                        //         contentType: false,
                        //         processData: false,
                        //         success: function(response) {
                        //             var data = JSON.parse(response);
                        //             var body = "";
                        //             if (data.content.length > 0) {
                        //                 $('#detailmodal').modal('show');
                        //                 val = data.content[0];
                        //                 $(".list-detail").html(" ");
                        //                 body += "<tr><td>id : <td><td>" + val.order_detail_id + "<td></tr>";
                        //                 body += "<tr><td>Kode Barang: <td><td>" + val.product_model + "<td></tr>";
                        //                 body += "<tr><td>Nama Barang: <td><td>" + val.product_name + "<td></tr>";
                                    

                        //                 $(".list-detail").html(body);
                        //             } else {
                        //                 alert("Gudang Detail Tidak Ditemukan");
                        //             }
                        //         },
                        //         error: function(error) {
                        //             alert("Terjadi Kesalahan");
                        //         }
                        //     });

                        // }
                    </script>
                    @endpush