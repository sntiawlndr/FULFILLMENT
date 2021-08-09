@extends('layout.app')
@section('content')

<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Edit Gudang
                        <a href="{{url('/gudang')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                </div>
            </div>
        </div>

        <div class="widget-content widget-content-area">

            <form>
                <div class="form-group row mb-4">
                    <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Gudang</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="location_name" placeholder="" name="location_name" value="{{$data['gudang']->location_name}}" required>
                        <input type="hidden" class="form-control" name="location_id" id="location_id" placeholder="" value="{{$data['gudang']->location_id}}">
                    </div>

                </div>
                <div class="form-group row mb-4">
                    <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kode Gudang</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="location_code" placeholder="" name="location_code" value="{{$data['gudang']->location_code}}">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Alamat</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="address" placeholder="" name="address" value="{{$data['address']->address}}">
                        <input type="hidden" class="form-control" name="address_id" id="address_id" placeholder="" value="{{$data['address']->address_id}}">

                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">No Hp</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">

                        <input type="text" class="form-control" id="address_telepon" placeholder="" name="address_telepon" value="{{$data['address']->address_telepon}}">

                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="javascript:void" class="btn btn-primary" id="saveButton">Save</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')

@push('jsfooter')
<script type="text/javascript">
    $("#saveButton").click(function() {

        formData = {
            'location_id': $("#location_id").val(),
            'address_id': $("#address_id").val(),
            'location_name': $("#location_name").val(),
            'location_code': $("#location_code").val(),
            'address': $("#address").val(),
            'address_telepon': $("#address_telepon").val(),
            // 'warehouse_status': $("#warehouse_status").val(),
            '_token': $("input[name='_token']").val()
        }


        $.ajax({
            url: "{{url('/gudang/update')}}",
            method: 'POST',
            data: formData,
            cache: false,
            success: function(response) {
                response = JSON.parse(response);
                if (response.success == true) {
                    alert('Simpan Data Berhasil');
                    location.reload();
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