@extends('layout.app_seller')
@section('content')


<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">                                
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Profile
                    <a href="{{url('/home')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                </div>                                                                        
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <form>
                <div class="form-row mb-4">
                    <div class="form-group col-md-6">
                        <label for="hEmail" class="col-xl-6 col-sm-6 col-form-label">Email</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" id="email" placeholder="" name="email" value="{{$profile->email}}">

                            <input type="hidden" class="form-control" id="user_id" placeholder=""  value="{{$profile->user_id}}">
                        @csrf
                    </div>
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="hEmail" class="col-xl-6 col-sm-6 col-form-label">Nama</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{$profile->name}}">
                    
                </div>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="form-group col-md-6">
                <label for="hEmail" class="col-xl-6 col-sm-6 col-form-label">No. Hp</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <input type="text" class="form-control" id="user_telepon" placeholder="" name="user_telepon" value="{{$profile->user_telepon}}">
                
            </div>
        </div>
    </div>
    <div class="form-row mb-4">
        <div class="form-group col-md-6">
            <label for="hEmail" class="col-xl-6 col-sm-6 col-form-label">Password</label>
            <div class="col-xl-10 col-lg-9 col-sm-10">
                <input type="text" class="form-control" id="password" placeholder="" name="password" >
            
        </div>
    </div>
</div>
<div class="form-row mb-4">
    <div class="form-group col-md-6">
        <label for="hEmail" class="col-xl-6 col-sm-6 col-form-label">Ulang Password Baru</label>
        <div class="col-xl-10 col-lg-9 col-sm-10">
            <input type="text" class="form-control" id="passwordconfirm" placeholder="" name="passwordconfirm" >
        
    </div>
</div>
</div>
               

            
              </form> 
                <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="javascript:void" class="btn btn-primary" id="saveButton" >Simpan</a>
                    </div>
                </div>
                
           
        </div>
    </div>
</div>



                        
                        
                        @endsection('content')