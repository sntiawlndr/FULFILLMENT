@extends('layout.app')
@section('content')
<br>

<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>category Edit
                                            <a href="{{url('/category')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form>
                                        <div class="form-group row mb-4">
                                            <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Parent</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <select id="category_parent_id" class="form-control" name="category_parent_id">
                                                    {{-- data jamak dijadikan satu  --}}
                                                    {{-- @foreach ($categories['category'] as $category) --}}
                                                    @foreach ($categories as $data )
                        
                                                    <option value="{{$data->category_parent_id}}">{{$data->category_name}}</option>
                        
                        
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="category_name" placeholder="" name="category_name" value="{{$category->category_name}}">

                                                <input type="hidden" class="form-control" id="category_id" placeholder=""  value="{{$category->category_id}}">
                                                @csrf
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <select id="product_status" class="form-control" name="product_status">
                        
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
        'category_id':$("#category_id").val(),
        'category_name':$("#category_name").val(),
        'category_parent_id':$("#category_parent_id").val(),
        '_token':$("input[name='_token']").val()
    }

  
     $.ajax({
                url:"{{url('/category/update')}}",
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
            
                                   