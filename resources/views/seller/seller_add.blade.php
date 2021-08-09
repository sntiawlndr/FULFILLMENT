@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Seller Add
                                            <a href="{{url('/seller')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>
                                    <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                            <label for="e_mail" >E-mail</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="email" class="form-control" id="seller_email" placeholder="" name="seller_email" required>
                                                @csrf
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >provinsi</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select   class="form-control select2" name="seller_id">
                                               
                                             </select>
                                             </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >Nama</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="seller_name" placeholder="" name="seller_name">
                                                @csrf
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >Kota</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select class="form-control select2" name="seller_id">
                                               
                                             </select>
                                             </div>
                                        </div>
                                     
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >No. HP</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="seller_telpon" placeholder="" name="seller_telpon">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >Kecamatan</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select  class="form-control select2" name="seller_id">
                                               
                                             </select>
                                             </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >Role</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select  class="form-control select2" name="role_id">
                                            {{-- data jamak dijadikan satu  --}}
                                                @foreach ($roles as $role)

                                                <option value="{{$role->group_role_id}}">{{$role->group_name}}</option>


                                                @endforeach
                                             </select>
                                             </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >Kode Pos</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select  class="form-control select2" name="seller_id">
                                               
                                             </select>
                                             </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                             <select class="selectpicker form-control" id="seller_status" class="form-control" name="seller_status">

                                                    <option if="" ($status="=" 1="" )="" echo="" 'selected'="" ;="" ?="">Enable</option>

                                                    <option if="" ($status="=" 2="" )="" echo="" 'selected'="" ;="" ?="">Disable</option>


                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >Alamat</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <textarea class="form-control" name="product_name" id="product_name"></textarea>
                                        </div>
                                        </div>
                                      </form> 
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <a href="javascript:void" class="btn btn-primary" id="saveButton" >Save</a>
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

    $("#saveButton").click(function(){
   
    formData = {
        'seller_email':$("#seller_email").val(),
        'seller_telpon':$("#seller_telpon").val(),
        'seller_name':$("#seller_name").val(),
        'seller_status':$("#seller_status").val(),
        '_token':$("input[name='_token']").val()
    }

  
     $.ajax({
                url:"{{url('/seller/save')}}",
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
            
                                   