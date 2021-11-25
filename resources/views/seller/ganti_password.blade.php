@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Ganti Password
                                            <a href="{{url('/seller')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                            <br>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>
                                        <div class="form-group row mb-4">

                                            <label for="hEmail" class="col-xl-5 col-sm-3 col-sm-2 col-form-label">Password Baru</label>
                                            <div class="col-xl-11 col-lg-9 col-sm-10">
                                            <input type="text" class="form-control" id="seller_password" placeholder="" name="seller_password" >

                                            <input type="hidden" class="form-control" id="seller_id" placeholder=""  value="{{$seller->seller_id}}">
                                            @csrf
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="hPassword" class="col-xl-5 col-sm-3 col-sm-2 col-form-label">Ulang Password Baru</label>
                                            <div class="col-xl-11 col-lg-9 col-sm-10">
                                            <input type="text" class="form-control" id="seller_password1" placeholder="" name="seller_password1">
                                            <div id="divCheckPassword"></div>    
                                        </div>
                                        </div>
                                        
                                       
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
    var ss = $(".select2").select2({
        tags: true,
    });


    $("#saveButton").click(function(){
    var password = $("#seller_password").val();
    var confirmPassword = $("#seller_password1").val();

    if (password != confirmPassword) {
        $("#divCheckPassword").html("Passwords do not match!");
    
    return false ;
    }
   
    formData = {
        'seller_id':$("#seller_id").val(),
        'seller_password':$("#seller_password").val(),
        '_token':$("input[name='_token']").val()
    }

  
    $.ajax({
                url:"{{url('/seller/updatepw')}}",
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