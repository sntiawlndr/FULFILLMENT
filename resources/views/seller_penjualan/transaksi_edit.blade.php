@extends('layout.app')
@section('content')

<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Edit Transaksi Penjualan
                        <a href="{{url('/transaksi')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                </div>
            </div>
        </div>

        <div class="widget-content widget-content-area">

            <form>
                <div class="form-group row mb-4">
                    <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="order_date" placeholder="" name="order_date" value="{{ $transaksi->order_date}}">
                        <input type="hidden" class="form-control" name="order_id" id="order_id" placeholder="" value="{{ $transaksi->order_id}}">
                    </div>

                </div>
                <div class="form-group row mb-4">
                    <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Order ID</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="order_id" placeholder="" name="order_id" value="{{ $transaksi->order_id}}">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">No Invoice</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="no_invoice" placeholder="" name="no_invoice" value="{{ $transaksi->no_invoice}}">
                        

                    </div>
                </div>
                
                <div class="form-group row mb-4">
                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Status</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                         <select id="status" class="form-control" name="status" value="{{ $transaksi->status}}">
                        
                                         <option value="unprocessed">Unprocessed</option>
                                          <option value="processed">Processed</option>
                                          
                                          
                        
                                            </select>

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
            'order_date': $("#order_date").val(),
            'order_id': $("#order_id").val(),
            'no_invoice': $("#no_invoice").val(),  
            'status': $("#status").val(),           
            '_token': $("input[name='_token']").val()
        }


        $.ajax({
            url: "{{url('/transaksi/update')}}",
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