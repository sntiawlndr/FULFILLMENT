@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> Add Barang
                        <a href="{{url('/barang')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <br>
            <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Seller</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select class="form-control select2" name="seller_id">
                        {{-- data jamak dijadikan satu  --}}
                        @foreach ($sellers as $seller)

                        <option value="{{$seller->seller_id}}">{{$seller->seller_name}}</option>


                        @endforeach
                    </select>

                    @csrf
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kategori</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select class="form-control select2" name="seller_id">
                        {{-- data jamak dijadikan satu  --}}
                        @foreach ($sellers as $seller)

                        <option value="{{$seller->seller_id}}">{{$seller->seller_name}}</option>


                        @endforeach
                    </select>

                    @csrf
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <textarea class="form-control" name="product_name" id="product_name"></textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SKU</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <textarea class="form-control" name="product_sku" id="product_sku"></textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Ukuran</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="size1" name="size" class="custom-control-input size" value="s">
                    <label class="custom-control-label" for="size1">S</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="size2" name="size" class="custom-control-input size" value="m">
                    <label class="custom-control-label" for="size2">M</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="size3" name="size" class="custom-control-input size" value="l">
                    <label class="custom-control-label" for="size3">L</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="size4" name="size" class="custom-control-input size" value="xl">
                    <label class="custom-control-label" for="size4">XL</label>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">

                    <select id="product_status" class="form-control" name="product_status">

                        <option if="" ($status="=" 1="" )="" echo="" 'selected'="" ;="" ?="">Enable</option>

                        <option if="" ($status="=" 2="" )="" echo="" 'selected'="" ;="" ?="">Disable</option>


                    </select>
                </div>
            </div>
            <br>


            <div class="form-group row">
                <div class="col-sm-10">
                    <a href="javascript:void" class="btn btn-primary" id="saveButton">Save</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
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
            'seller_id': $("#seller_id").val(),
            'product_name': $("#product_name").val(),
            'product_sku': $("#product_sku").val(),
            'size': $(".size:checked").val(),
            'product_status': $("#product_status").val(),
            '_token': $("input[name='_token']").val()
        }


        $.ajax({
            url: "{{url('/barang/save')}}",
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