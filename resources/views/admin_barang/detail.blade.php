@extends('layout.app')
@section('content')

<br>
<div id="flHorizontalForm" class="col-lg-12  col-md-6 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-6 ">
                    <h4>Detail Barang</h4>
                    <br>
                </div>
            </div>
        </div>

        <div class="widget-content widget-content-area">
            <form>
                <div class="form-group row mb-4">

                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Seller</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="seller_name" placeholder="" name="seller_name"
                            readonly="" value="{{$data['seller']->seller_name}}">
                        <input type="hidden" class="form-control" id="seller_id" placeholder="" name="seller_id"
                            value="{{$data['seller']->seller_id}}">
                        @csrf
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kategori</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="category_name" placeholder="" name="category_name"
                            readonly="" value="{{$data['category']->category_name}}">
                        <input type="hidden" class="form-control" id="category_id" placeholder="" name="category_id"
                            value="{{$data['category']->category_id}}">

                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="product_name" placeholder="" name="product_name"
                            readonly="" value="{{$data['barang']->product_name}}">
                        <input type="hidden" class="form-control" id="product_id" name="product_id" placeholder=""
                            value="{{$data['barang']->product_id}}">
                    </div>
                </div>


                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SKU</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="product_sku" placeholder="" name="product_sku"
                            readonly="" value="{{$data['barang']->product_sku}}">

                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Ukuran</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="size" placeholder="" name="size" readonly=""
                            value="{{$data['barang']->size}}">

                    </div>
                </div>



                <div id="tabsSimple" class="col-lg-12  col md-6 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-10 col-md-6 col-sm-10 col-10">
                                    <h4>List Barang</h4>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="filter-status1" name="inventory_status"
                                    class="custom-control-input filter-status" value="semua">
                                <label class="custom-control-label" for="filter-status1">Semua</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="filter-status2" name="inventory_status"
                                    class="custom-control-input filter-status" value="enable">
                                <label class="custom-control-label" for="filter-status2">Enable</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="filter-status3" name="inventory_status"
                                    class="custom-control-input filter-status" value="disable">
                                <label class="custom-control-label" for="filter-status3">Disable</label>
                            </div>

                        </div>

                        {{-- <select id="filter-status" class="selectpicker mb-4 ml-3" data-style="btn btn-outline-info">
                                    <option value="">--Show All--</option>
                                    <option value="enable">Enable</option>
                                    <option value="disable">Disable</option>
                                </select> 
                 --}}

                        <div class="tab-content" id="simpletabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-4" id="zero-config">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>UID</th>
                                                <th>Lokasi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <input type="hidden" class="form-control" id="seller_id" value="{{$data['d']}}">
                            </div>

            </form>
            <div class="left-button">
                <a href="{{url('/barang')}}" class="btn btn-dark"
                    style="float:right;margin-top: -1%;color:#fff;">Tutup</a>
            </div>
        </div>
    </div>
</div>


@endsection('content')

@push('jsfooter')
<script type="text/javascript">
    $('.filter-status').change(function () {
        var status = $(this).val()
        if (status !== "") {
            load_data();
        }

    })

    var ss = $(".select2").select2({
        tags: true
    });

    $(".size").each(function () {
        if ($(this).val() == "{{$data['barang']->size}}") {
            $(this).attr("checked", "true");

        }
    })
    $("#saveButton").click(function () {

        formData = {
            'product_id': $("#product_id").val(),
            'seller_id': $("#seller_id").val(),
            'seller_name': $("#seller_name").val(),
            'category_id': $("#category_id").val(),
            'category_name': $("#category_name").val(),
            'product_name': $("#product_name").val(),
            'product_sku': $("#product_sku").val(),
            'size': $(".size:checked").val(),
            'inventory_status': $("#inventory_status").val(),
            '_token': $("input[name='_token']").val()
        }


        $.ajax({
            url: "{{url('/barang/update')}}",
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
    $(document).ready(function () {
        load_data();
    })

    function load_data() {
        $('#zero-config').DataTable().destroy();
        $('#zero-config').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{url('detail/datatable')}}",
                "type": "POST",
                "data": {
                    '_token': $("input[name='_token']").val(),
                    'seller_id': $("#seller_id").val(),
                    'status': $('.filter-status:checked').val()
                }
            },
            "columns": [{
                    "data": null,
                    "sortable": false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "uid"
                },
                {
                    data: "position"
                },
                {
                    data: "inventory_status"
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
</script>
@endpush@extends('layout.app')
@section('content')

<br>
<div id="flHorizontalForm" class="col-lg-12  col-md-6 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-6 ">
                    <h4>Detail Barang</h4>
                    <br>
                </div>
            </div>
        </div>

        <div class="widget-content widget-content-area">
            <form>
                <div class="form-group row mb-4">

                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Seller</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="seller_name" placeholder="" name="seller_name"
                            readonly="" value="{{$data['seller']->seller_name}}">
                        <input type="hidden" class="form-control" id="seller_id" placeholder="" name="seller_id"
                            value="{{$data['seller']->seller_id}}">
                        @csrf
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kategori</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="category_name" placeholder="" name="category_name"
                            readonly="" value="{{$data['category']->category_name}}">
                        <input type="hidden" class="form-control" id="category_id" placeholder="" name="category_id"
                            value="{{$data['category']->category_id}}">

                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="product_name" placeholder="" name="product_name"
                            readonly="" value="{{$data['barang']->product_name}}">
                        <input type="hidden" class="form-control" id="product_id" name="product_id" placeholder=""
                            value="{{$data['barang']->product_id}}">
                    </div>
                </div>


                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SKU</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="product_sku" placeholder="" name="product_sku"
                            readonly="" value="{{$data['barang']->product_sku}}">

                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Ukuran</label>
                    <div class="col-xl-9 col-lg-9 col-sm-9">
                        <input type="text" class="form-control" id="size" placeholder="" name="size" readonly=""
                            value="{{$data['barang']->size}}">

                    </div>
                </div>



                <div id="tabsSimple" class="col-lg-12  col md-6 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-10 col-md-6 col-sm-10 col-10">
                                    <h4>List Barang</h4>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="filter-status1" name="inventory_status"
                                    class="custom-control-input filter-status" value="semua">
                                <label class="custom-control-label" for="filter-status1">Semua</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="filter-status2" name="inventory_status"
                                    class="custom-control-input filter-status" value="enable">
                                <label class="custom-control-label" for="filter-status2">Enable</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="filter-status3" name="inventory_status"
                                    class="custom-control-input filter-status" value="disable">
                                <label class="custom-control-label" for="filter-status3">Disable</label>
                            </div>

                        </div>

                        {{-- <select id="filter-status" class="selectpicker mb-4 ml-3" data-style="btn btn-outline-info">
                                    <option value="">--Show All--</option>
                                    <option value="enable">Enable</option>
                                    <option value="disable">Disable</option>
                                </select> 
                 --}}

                        <div class="tab-content" id="simpletabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-4" id="zero-config">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>UID</th>
                                                <th>Lokasi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <input type="hidden" class="form-control" id="seller_id" value="{{$data['d']}}">
                            </div>

            </form>
            <div class="left-button">
                <a href="{{url('/barang')}}" class="btn btn-dark"
                    style="float:right;margin-top: -1%;color:#fff;">Tutup</a>
            </div>
        </div>
    </div>
</div>


@endsection('content')

@push('jsfooter')
<script type="text/javascript">
    $('.filter-status').change(function () {
        var status = $(this).val()
        if (status !== "") {
            load_data();
        }

    })

    var ss = $(".select2").select2({
        tags: true
    });

    $(".size").each(function () {
        if ($(this).val() == "{{$data['barang']->size}}") {
            $(this).attr("checked", "true");

        }
    })
    $("#saveButton").click(function () {

        formData = {
            'product_id': $("#product_id").val(),
            'seller_id': $("#seller_id").val(),
            'seller_name': $("#seller_name").val(),
            'category_id': $("#category_id").val(),
            'category_name': $("#category_name").val(),
            'product_name': $("#product_name").val(),
            'product_sku': $("#product_sku").val(),
            'size': $(".size:checked").val(),
            'inventory_status': $("#inventory_status").val(),
            '_token': $("input[name='_token']").val()
        }


        $.ajax({
            url: "{{url('/barang/update')}}",
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
    $(document).ready(function () {
        load_data();
    })

    function load_data() {
        $('#zero-config').DataTable().destroy();
        $('#zero-config').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{url('detail/datatable')}}",
                "type": "POST",
                "data": {
                    '_token': $("input[name='_token']").val(),
                    'seller_id': $("#seller_id").val(),
                    'status': $('.filter-status:checked').val()
                }
            },
            "columns": [{
                    "data": null,
                    "sortable": false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "uid"
                },
                {
                    data: "position"
                },
                {
                    data: "inventory_status"
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
</script>
@endpush