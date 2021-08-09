@extends('layout.app')
@section('content')

<br>
<div id="flHorizontalForm" class="col-lg-12  col-md-6 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                            <h4>Detail 
                                            <a href="{{url('/invoice')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                            <br>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>
                                    <div class="form-group row mb-4">                            
                                            <label for="e_mail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">E-mail</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-5">
                                                <input type="email" class="form-control" id="order_email" placeholder="" name="order_email"  value="{{$order->order_email}}" required>
                                                <input type="hidden" class="form-control" id="order_id" name="order_id"  placeholder=""  value="{{$order->order_id}}">
                                                @csrf
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Nama</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-5">
                                                <input type="text" class="form-control" id="customer_name" placeholder="" name="customer_name" value="{{$order->customer_name}}">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">No.HP</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="order_telpon" placeholder="" name="order_telpon" value="{{$order->order_telpon}}">
                                            </div>
                                        </div>

                                       

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label" >Status</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="order_status" placeholder="" name="order_status" value="{{$order->order_status}}">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-1 col-sm-3 col-sm-2 col-form-label" >Jumlah Tagihan</label>
                                            <div class="col-xl-5 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="amount" placeholder="" name="amount" value="{{$order->amount}}">
                                                
                                            </div>
                                        </div>
                                        <div id="tabsSimple" class="col-lg-7  col md-6 col-7 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-10 col-md-6 col-sm-10 col-10">
                                            <h4>Detail</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area simple-tab">
                                    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Masuk</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Keluar</a>
                                        </li>
                                
                                    </ul>
                                    <div class="tab-content" id="simpletabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-4" id="zero-config">
                                                <thead>
                                                    <tr>
                                                        <th>Tgl Masuk</th>
                                                        <th>Nama</th>
                                                        <th>Size</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-4" id="zero-config">
                                                    <thead>
                                                        <tr>
                                                            <th>Tgl Keluar</th>
                                                            <th>Nama</th>
                                                            <th>Size</th>
                                                            <th>Qty</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                      <div class="form-group row">
                                            <div class="col-sm-10">
                                                <a href="javascript:void" class="btn btn-primary" id="saveButton">Save</a>
                                                </form>
                                                
                                </div>
                            </div>
                        </div>
                        
                        
                        @endsection('content')

    @push('jsfooter')
    <script type="text/javascript">
     $("#saveButton").click(function(){
   
    formData = {
        'order_id':$("#order_id").val(),
        'order_email':$("#order_email").val(),
        'customer_name':$("#customer_name").val(),
        'order_telpon':$("#order_telpon").val(),
        'order_status':$("#order_status").val(),
        'amount':$("#amount").val(),
        '_token':$("input[name='_token']").val()
    }

    $.ajax({
                url:"{{url('/invoice/update')}}",
                method: 'POST',
                data: formData,
                cache: false,
                success: function(response) {
                   response = JSON.parse(response);
                   if(response.success == true){
                        alert('Simpan Data Berhasil');
                        location.reload();
                   }else{
                    alert("Gagal Menyimpan Data");
                   }
                },error: function (error) {
                     alert("Terjadi Kesalahan");          
                }
           });
});
    </script>
    @endpush
