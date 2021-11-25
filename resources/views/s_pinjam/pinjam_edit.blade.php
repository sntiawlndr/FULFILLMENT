@extends('layout.app_seller')
 

@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> Detail Transaksi Pinjam
                        <a href="{{url('/pinjam')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <br>

             <div class="form-row mb-4">
                <div class="form-group col-md-4">
                    <label for="hEmail">Nama Penerima</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">
                        <input type="text" class="form-control" id="borrow_name" placeholder="" name="borrow_name" value="{{$data['orders']->customer_name}}">

                    @csrf
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="hEmail">No. HP Penerima</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <input type="text" class="form-control" id="borrow_telepon" placeholder="" name="borrow_telepon" value="{{$data['orders']->order_telpon}}">

               
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleFormControlInput1">Pengiriman</label>
            <div class="col-xl-10 col-lg-9 col-sm-10">  
            <select class="form-control select2" id="pengiriman" name="pengiriman" >
                <option value="{{$data['orders']->order_delivery}}">{{$data['orders']->order_delivery}}</option>
                {{-- <option value="Ekspedisi">Ekspedisi</option>
                <option value="Kurir">Kurir</option> --}}
            </select>

            @csrf
        </div>
    </div>
  
    <div class="form-group col-md-4">
        <label for="platform-description">Alamat Konsumen</label>
        <textarea type="text" class="form-control mb-4" id="address" name="address" placeholder="" rows="5"  > {{$data['address']->address}}</textarea>
        
    </div>
                
               <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">provinsi</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">  
                        <select onchange="getProv()" class="form-control select2" id="address_prov"
                            name="address_prov">
                            @foreach ($data['provinces'] as $provinsi)
                           
                            <option value="{{$provinsi->prov_id}}" @if ($data['address']->country_id == $provinsi->prov_id )
                                
                           selected
                                
                            @endif> {{$provinsi->prov_name}}</option>
                            
                            
                            @endforeach

                        </select>

                    @csrf
                </div>
                <label for="exampleFormControlInput1">Kota</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select onchange="getCity()" class="form-control select2" id="address_city"
                    name="address_city">
                    @foreach ($data['cities'] as $city)
                   
                    <option value="{{$city->city_id}}" @if ($data['address']->address_city == $city->city_id )
                        
                   selected
                        
                    @endif> {{$city->city_name}}</option>
                    
                    
                    @endforeach

                </select>
                
            </div>
            
            </div>

            <div class="form-group col-md-4">
                <label for="exampleFormControlInput1">Kecamatan</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
               
                    <select class="form-control select2" id="address_kec" name="address_kec">
                        @foreach ($data['districts'] as $kecamatan)
                   
                        <option value="{{$kecamatan->dis_id}}" @if ($data['address']->address_districts == $kecamatan->dis_id )
                            
                       selected
                            
                        @endif> {{$kecamatan->dis_name}}</option>
                        
                        
                        @endforeach
                    </select>

                @csrf
            </div>
            <label for="exampleFormControlInput1">Kode Pos</label>
            <div class="col-xl-10 col-lg-9 col-sm-10">
            <input type="text" class="form-control" id="postal_code" placeholder="" name="postal_code" value="{{$data['address']->address_postal_code}}">

            @csrf
        </div>
        </div>

    {{-- <div class="form-group col-md-4">
        <label for="exampleFormControlInput1">Barang</label>
        <div class="col-xl-10 col-lg-9 col-sm-10">
            <select class="form-control select2" id="nama_barang" name="nama_barang">
               
            </select>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label for="exampleFormControlInput1">jumlah</label>
        <div class="col-xl-20 col-lg-10 col-sm-10">
            <input type="number" class ="form-control selectnum" id="quantity" name="quantity" min="1" max="100" >
        </div>
    </div>     --}}

    <div class="form-group col-md-4">
        <label for="hEmail">Note Pengiriman</label>
        <div class="col-xl-10 col-lg-9 col-sm-10">
            <input type="text" class="form-control" id="note" placeholder="" name="note" value="{{$data['orders']->type}}">

       
    </div>
</div>
</div>

    {{-- <div class="form-group row">
        <div class="col-sm-12">
            <button type="button" class="tambah btn-primary" > Tambah </button>
        </div>
    </div> --}}

           
        

          
<br>
 <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-4" name="record">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>SKU</th>
                                    <th>Model</th>
                                    <th>Jumlah</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['ordels'] as $item)
                                <tr>
                                
                                    <td> </td>
                                    <td> <input type="text" value="{{$item->product_name}}"> </td>
                                    <td> <input type="text" value="{{$item->product_sku}}"> </td>
                                    <td> <input type="text" value="{{$item->product_model}}"> </td>
                                    <td> <input type="text" value="{{$item->quantity}}"> </td>
                                    </tr>
                                @endforeach
                              
                               

                            </tbody>
                        </table>
                    </div>
                  <br>
                   <br>

                </div>
                <br>
               
                 {{-- <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="javascript:void" id="saveButton" class="btn btn-primary">Simpan</a>
                    </div> --}}
             
         </div>
     </div>
    </div>
</div>
@endsection('content')
@push('jsfooter')
@endpush