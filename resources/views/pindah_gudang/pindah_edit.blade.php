@extends('layout.app')
@section('content')

<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Edit Pindah Gudang
                        <a href="{{url('/pindah')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                </div>
            </div>
        </div>

        <div class="widget-content widget-content-area">

            <form>
                <div class="form-group row mb-4">
                    <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="warehouse_date" placeholder="" name="warehouse_date" value="{{$data['pindah']->warehouse_date}}" required>
                        <input type="hidden" class="form-control" name="warehouse_id" id="warehouse_id" placeholder="" value="{{$data['pindah']->warehouse_id}}">
                    </div>

                </div>
                <div class="form-group row mb-4">
                    <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">id</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="warehouse_code" placeholder="" name="warehouse_code" value="{{$data['pindah']->warehouse_code}}">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Gudang Tujuan</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="destination" placeholder="" name="destination" value="{{$data['pindah']->destination}}">
                        <input type="hidden" class="form-control" name="warehouse_id" id="warehouse_id" placeholder="" value="{{$data['pindah']->warehouse_id}}">

                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Status</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">

                        <input type="text" class="form-control" id="status" placeholder="" name="status" value="{{$data['pindah']->status}}">

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
            'warehouse_id': $("#warehouse_id").val(),
            'warehouse_date': $("#warehouse_date").val(),
            'warehouse_code': $("#warehouse_code").val(),
            'destination': $("#destination").val(),
            'status': $("#status").val(),
            '_token': $("input[name='_token']").val()
        }


        $.ajax({
            url: "{{url('/pindah/update')}}",
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