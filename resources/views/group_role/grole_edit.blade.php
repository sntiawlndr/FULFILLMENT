@extends('layout.app')
@section('content')
<br>

<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>grole Edit
                                            <a href="{{url('/grole')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="group_name" placeholder="" name="group_name" value="{{$grole->group_name}}">

                                                <input type="hidden" class="form-control" id="group_role_id" placeholder=""  value="{{$grole->group_role_id}}">
                                                @csrf
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <select id="group_status" class="form-control" name="group_status">
                        
                                                    <option value="enable">Enable</option>
                        
                                                    <option value="disable">Disable</option>
                        
                                                </select>
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
$("#saveButton").click(function(){
   
    formData = {
        'group_role_id':$("#group_role_id").val(),
        'group_name':$("#group_name").val(),
        'group_status':$("#group_status").val(),
        '_token':$("input[name='_token']").val()
    }

  
     $.ajax({
                url:"{{url('/grole/update')}}",
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
            
                                   