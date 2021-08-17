@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> Add Pindah Gudang
                        <a href="{{url('/gudang')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <br>

            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="hEmail">Gudang Tujuan</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <select class="form-control select2" name="seller_id">
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="hEmail">catatan</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="warehouse_name" placeholder="" name="warehouse_name">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">seller</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <select class="form-control select2" name="seller_id">
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">Barang</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <select class="form-control select2" name="product_id">
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">jumlah</label>
                    <div class="col-xl-10 col-lg-9 col-sm-9">
                        <input type="number" id="warehouse_detail_id" name="quantity" min="1" max="5">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="javascript:void" class="btn btn-primary" id="saveButton">Tambah</a>
                    </div>
                </div>

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
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="javascript:void" class="btn btn-primary" id="saveButton">Simpan</a>
                    </div>
                </div>

            </div>


            @endsection('content')
            @push('jsfooter')

            <script type="text/javascript">
                var ss = $(".select2").select2({
                    tags: true,
                });

                $("#saveButton").click(function() {

                    formData = {
                        'warehouse_code': $("#warehouse_code").val(),
                        'notes': $("#notes").val(),
                        // 'seller_id': $("#seller_id").val(),
                        // 'product_id': $("product_id").val(),
                        // 'order_id': $("#order_id").val(),
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
            </script>
            @endpush