@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> Add Gudang
                        <a href="{{url('/gudang')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <br>
            <form>
                <div class="form-row mb-4">
                    <div class="form-group col-md-6">
                        <label for="hEmail">Nama Gudang</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" id="location_name" placeholder="" name="location_name">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hEmail">provinsi</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select class="form-control select2" name="seller_id">

                            </select>
                        </div>
                    </div>
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="hEmail">Kode Gudang</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" id="werehouse_code" placeholder="" name="location_code">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hEmail">Kota</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select class="form-control select2" name="seller_id">

                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="hEmail">No Hp</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" id="address_telepon" placeholder="" name="address_telepon">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hEmail">Kecamatan</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select class="form-control select2" name="seller_id">

                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">

                            <select id="gudang_status" class="form-control" name="gudang_status">

                                <option value="enable">Enable</option>

                                <option value="disable">Disable</option>


                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hEmail">Kode Pos</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <select class="form-control select2" name="seller_id">

                            </select>
                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="hEmail">Alamat</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="address" id="address"></textarea>
                        </div>
                    </div>
            </form>
            <div class="form-group row">
                <div class="col-sm-10">
                    <a href="javascript:void" class="btn btn-primary" id="saveButton">Save</a>
                </div>
            </div>


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
            'address_id': $("#address_id").val(),
            'location_name': $("#location_name").val(),
            'location_code': $("#location_code").val(),
            'address_telepon': $("location_telepon").val(),
            'warehouse_status': $("#warehouse_status").val(),
            '_token': $("input[name='_token']").val()
        }


        $.ajax({
            url: "{{url('/gudang/save')}}",
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


<!-- <div class="form-group col-md-6">
        <label for="hEmail">No HP</label>
        <div class="col-xl-10 col-lg-9 col-sm-10">
            <select id="seller_id" class="form-control" name="seller_id">

            </select>
        </div>
    </div> -->