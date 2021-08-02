@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Seller Edit
                                            <a href="{{url('/seller')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>
                                    <div class="form-group row mb-4">                            
                                            <label for="e_mail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">E-mail</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="email" class="form-control" id="seller_email" placeholder="" name="seller_email"  value="{{$seller->seller_email}}" required>
                                                <input type="hidden" class="form-control" id="seller_id" placeholder=""  value="{{$seller->seller_id}}">
                                                @csrf
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">No. HP</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="seller_telpon" placeholder="" name="seller_telpon" value="{{$seller->seller_telpon}}">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="seller_name" placeholder="" name="seller_name" value="{{$seller->seller_name}}">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label" >Group</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="group_role" placeholder="" name="group_role" value="{{$seller->group_role}}">
                                                
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
        'seller_id':$("#seller_id").val(),
        'seller_email':$("#seller_email").val(),
        'seller_telpon':$("#seller_telpon").val(),
        'seller_name':$("#seller_name").val(),
        'group_role':$("#group_role").val(),
        '_token':$("input[name='_token']").val()
    }

    $.ajax({
                url:"{{url('/seller/update')}}",
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
            
                                   