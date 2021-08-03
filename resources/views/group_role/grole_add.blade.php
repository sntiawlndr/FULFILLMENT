@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Tambah Role
                                            <a href="{{url('/grole')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="hEmail" class="col-xl-6 col-sm-6 col-form-label">Nama Role</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="group_name" placeholder="" name="group_name" required>
                                                @csrf
                                            </div>
                                        </div>
                                    </div>
                                       

                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                             <select class="selectpicker form-control" id="group_status" class="form-control" name="group_status">

                                                    <option if="" ($status="=" 1="" )="" echo="" 'selected'="" ;="" ?="">Enable</option>

                                                    <option if="" ($status="=" 2="" )="" echo="" 'selected'="" ;="" ?="">Disable</option>


                                                </select>
                                            </div>
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
        'group_name':$("#group_name").val(),
        'group_status':$("#group_status").val(),

        '_token':$("input[name='_token']").val()
    }

  
     $.ajax({
                url:"{{url('/grole/save')}}",
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
            
                                   