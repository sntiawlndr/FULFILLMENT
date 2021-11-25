@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> Add Pindah Gudang
                        <a href="{{url('/pindah')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <br>

            <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gudang Tujuan</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select id ="destination" class="form-control select2" name="destination">

                        @foreach ($data['pindahs'] as $pindah) 
                        
                        <option value="{{$pindah->warehouse_id}}">{{$pindah->destination}}</option>


                        @endforeach
                    </select>

                    @csrf
                </div>
            </div>

                <div class="form-group col-md-6">
                    <label for="hEmail">Catatan</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <textarea class="form-control" id="notes" placeholder="" name="notes"></textarea> 
                    </div>
                </div>
               <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Seller</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select class="form-control select2" name="seller_id">
                        @foreach ($data['sellers'] as $seller) 
                        
                        <option value="{{$seller->seller_id}}">{{$seller->seller_name}}</option>


                        @endforeach
                    </select>

                    @csrf
                </div>
            </div>

                <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Barang</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select class="form-control select2" name="seller_id">
                        @foreach ($data['products'] as $product) 
                        
                        <option value="{{$product->product_id}}">{{$product->product_name}}</option>


                        @endforeach
                    </select>

                    @csrf
                </div>
            </div>

                <br>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">jumlah</label>
                    <div class="col-xl-20 col-lg-10 col-sm-10">
                        <input type="number" class ="form-control selectnum" id="quantity" name="quantity" min="1" max="100" >
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="javascript:void" class="btn btn-primary" id="saveButton">Save</a>
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
                                    <th>Seller</th>
                                    <th>Nama Barang</th>
                                    <th>SKU</th>
                                    <th>Jumlah</th>
                                    
                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                        </table>
                        <br>
                         <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="{{url('pindah/show')}}" class="btn btn-primary" id="saveButton">Simpan</a>
                    </div>
                </div>
                    </div>





            @endsection('content')
            @push('jsfooter')

            <script type="text/javascript">

                var ss = $(".select2").select2({
                    tags: true,
                });
                 var ab = $(".selectnum").selectnum({
                    tags: true,
                });
                 $(document).ready(function() {
                            load_data();
                        })

                        function load_data() {
                            $('#zero-config').DataTable().destroy();
                            $('#zero-config').DataTable({
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    "url": "{{url('/tampil/datatable')}}",
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
                                        data: "seller_name"
                                    },

                                    {
                                        data: "product_name"
                                    },
                                    {
                                        data: "product_sku"
                                    },

                                    {
                                        data: "status"
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



                $("#saveButton").click(function() {

                    formData = {
                        'destination': $("#destination").val(),
                        'notes': $("#notes").val(),
                         'seller_id': $("#seller_id").val(),
                         'product_id': $("product_id").val(),
                         'warehouse_detail_id': $("warehouse_detail_id").val(),
                        '_token': $("input[name='_token']").val()
                    }


                    $.ajax({
                        url: "{{url('/pindah/save')}}",
                        method: 'POST',
                        data: formData,
                        cache: false,
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.success == true) {
                                alert('Simpan Data Berhasil');
                                // location.reload();
                            } else {
                                alert("Gagal Menyimpan Data");
                            }
                        },
                        error: function(error) {
                            alert("Terjadi Kesalahan");
                        }
                    });
                });

                // $("#saveButton").click(function() { 

                //     formData = {

                //         'warehouse_detail_id': $("warehouse_detail_id").val(),
                //         'seller_name': $("#seller_name").val(),
                //          'seller_id': $("#seller_id").val(),
                //          'product_name': $("product_name").val(),
                //           'product_model': $("product_model").val(),
                //          'quantity': $("#quantity").val(),
                //         '_token': $("input[name='_token']").val()
                //     }


                //     $.ajax({
                //         url: "{{url('/pindah/tampil')}}",
                //         method: 'POST',
                //         data: formData,
                //         cache: false,
                //         success: function(response) {
                //             response = JSON.parse(response);
                //             if (response.success == true) {
                //                 alert('Simpan Data Berhasil');
                //                 // location.reload();
                //             } else {
                //                 alert("Gagal Menyimpan Data");
                //             }
                //         },
                //         error: function(error) {
                //             alert("Terjadi Kesalahan");
                //         }
                //     });
                // });
            </script>
            @endpush