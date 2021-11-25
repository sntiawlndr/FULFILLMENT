@extends('layout.app')
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> Tambah User
                        <a href="{{url('/user')}}" class="btn btn-dark"
                            style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <br>

            <div class="form-group row mb-4">
                <label for="e_mail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">E-mail</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="{{$data['users']->email}}">

                    <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="" value="{{$data['users']->user_id}}">
                           
                          
                        @csrf
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="{{$data['users']->name}}">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">No. Hp</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <input type="text" class="form-control" name="user_telepon" id="user_telepon" value="{{$data['users']->user_telepon}}"></textarea>
                </div>
            </div>
            
            {{-- <div class="form-group row mb-4">
                <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <input type="text" class="form-control" id="password" placeholder="" name="password" required>
                </div>
            </div> --}}
            



            <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Role</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select class="form-control role2" id="group_role" name="group_role" value="{{$data['users']->group_role}}">
                        
                        {{-- @foreach ($data['roles2'] as $role)

                        <option value="{{$role->group_role_id}}">{{$role->group_name}}</option>


                        @endforeach --}}
                    </select>

                </div>
            </div>
            {{-- untuk gudang --}}
            {{-- <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kategori</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select class="form-control select2" name="seller_id">
                      
                        @foreach ($sellers as $seller)

                        <option value="{{$seller->seller_id}}">{{$seller->seller_name}}</option>


                        @endforeach
                    </select>

                    @csrf
                </div>
            </div> --}}
            
            

            <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">

                    <select id="user_status" class="form-control" name="user_status" >
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
    tags: true
});


$(".role2").select2_modified({url:"{{url('/select2/get-raw')}}",token:$("input[name='_token']").val(),label:'pilih tipe',field:'fm_group_role',id:'group_role_id',name:'group_name',value:{id:"{{$data['roles']->group_role_id}}",text:"{{$data['users']->group_role}}"}});

$("#saveButton").click(function () {

formData = {
    'user_id': $("#user_id").val(),
    'email': $("#email").val(),
    'name': $("#name").val(),
    'user_telepon': $("#user_telepon").val(),
    'group_role': $("#group_role").val(),
    'user_status': $("#user_status").val(),
    
    '_token': $("input[name='_token']").val()
}


$.ajax({
    url: "{{url('/user/update')}}",
    method: 'POST',
    data: formData,
    cache: false,
    success: function (response) {
        response = JSON.parse(response);
        if (response.success == true) {
            alert('Simpan Data Berhasil');
            location.reload();
        } else {
            alert("Gagal Menyimpan Data");
        }
    },
    error: function (error) {
        alert("Terjadi Kesalahan");
    }
});
});
</script>
@endpush