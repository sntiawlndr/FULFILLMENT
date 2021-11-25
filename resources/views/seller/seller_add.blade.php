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
                                            <select onchange="getProv()" class="form-control select2" id="address_prov" name="address_prov"> 
                                            @foreach ($data['provinces'] as $provinsi)
                                            <option value="{{$provinsi->prov_id}}">{{$provinsi->prov_name}}</option> 

                                            @endforeach

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
                                            <select onchange="getCity()" class="form-control select2" id="address_city" name="address_city">
                                              <select class="form-control select2" id="address_city" name="address_city">
                                               
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
                                            <select onchange="getKecamatan()" class="form-control select2" id="address_kec" name="address_kec">
                                             </select>
                                             </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >Group</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select  class="form-control select2" name="seller_group_id" id="seller_group_id">
                                            {{-- data jamak dijadikan satu  --}}
                                                @foreach ($data['groupsellers'] as $groupseller)

                                                <option value="{{$groupseller->seller_group_id}}">{{$groupseller->group_name}}</option>


                                                @endforeach
                                             </select>
                                             </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="hEmail" >Kode Pos</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" class="form-control" id="address_postal_code" placeholder="" name="address_postal_code">
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
                                        <textarea class="form-control" name="address" id="address"></textarea>
                                        </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="hEmail"></label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <div id="map" style="width:100%;height:50px;"></div>
                                                <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDfHGKSbR4aEs2CLxlLI0VqIEYWZgwPygc"></script>
                                                <script>
                                                function initialize() {
                                                  var propertiPeta = {
                                                    center:new google.maps.LatLng(-6.909538576730218, 107.60837029646565),
                                                    zoom:9,
                                                    mapTypeId:google.maps.MapTypeId.ROADMAP
                                                  };
                                                  
                                                  var peta = new google.maps.Map(document.getElementById("map"), propertiPeta);
                                                  
                                                  // membuat Marker
                                                  var marker=new google.maps.Marker({
                                                      position: new google.maps.LatLng(-6.909538576730218, 107.60837029646565),
                                                      map: peta,
                                                      animation: google.maps.Animation.BOUNCE
                                                  });
                                                
                                                }
                                                
                                                // event jendela di-load  
                                                google.maps.event.addDomListener(window, 'load', initialize);
                                                </script>
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
        'address_id':$("#address_id").val(),
        'seller_email':$("#seller_email").val(),
        'seller_telpon':$("#seller_telpon").val(),
        'seller_name':$("#seller_name").val(),
        'seller_group_id':$("#seller_group_id").val(),
        'seller_status':$("#seller_status").val(),
        'address_prov':$("#address_prov").val(),
        'address_city':$("#address_city").val(),
        'address_kec':$("#address_kec").val(),
        'address':$("#address").val(),
        'address_postal_code':$("#address_postal_code").val(),
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
function getProv() {
       var clause = {fields:"prov_id",values:$("#address_prov").val()};
        $("#address_city").select2_modified({url:"{{url('/select2/get-raw')}}",label:'Pilih Kota',token:$("input[name='_token']").val(),field:"cities",id:"city_id",name:"city_name",clause:clause});
        // baris ketiga menunjukan nama tabel tujuan, baris kesatu menunjukan where nya
   } 


function getCity() {        
        var clause = {fields:"city_id",values:$("#address_city").val()};
        $("#address_kec").select2_modified({url:"{{url('/select2/get-raw')}}",label:'Pilih Kecamatan',token:$("input[name='_token']").val(),field:"districts",id:"dis_id",name:"dis_name",clause:clause});
        }
    </script>
    @endpush
            
                                   