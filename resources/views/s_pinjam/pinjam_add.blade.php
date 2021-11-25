@extends('layout.app_seller')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script>
    $(document).ready(function(){
        $(".tambah").click(function(){
           
            var nama_barang = $("#nama_barang option:selected").text();
            
            var barang_id = $("#nama_barang option:selected").val();
            var barang_nama = nama_barang.split("-")[0];
            var product_sku = nama_barang.split("-")[1];
            var product_model = nama_barang.split("-")[2];
            var jumlah = $("#quantity").val();
            var markup = "<tr><td></td><td><input type='text' name='nama_barangs' value='"+barang_nama+"' readonly>  <input type='hidden' name='barang_ids' value='"+barang_id+"'></td><td class='skus'>"+product_sku+"</td><td class='models'>"+product_model+"</td><td class='jumlahs'>" + jumlah + "</td></tr>";
            $("table tbody").append(markup);
        });
        
        // Find and remove selected table rows
       


       
    });    
</script>
@section('content')
<br>
<div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> Tambah Transaksi Pinjam
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
                        <input type="text" class="form-control" id="borrow_name" placeholder="" name="borrow_name">

                    @csrf
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="hEmail">No. HP Penerima</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <input type="text" class="form-control" id="borrow_telepon" placeholder="" name="borrow_telepon">

               
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleFormControlInput1">Pengiriman</label>
            <div class="col-xl-10 col-lg-9 col-sm-10">  
            <select class="form-control select2" id="pengiriman" name="pengiriman">
                <option value="Pickup">Pickup</option>
                <option value="Ekspedisi">Ekspedisi</option>
                <option value="Kurir">Kurir</option>
            </select>

            @csrf
        </div>
    </div>
  
    <div class="form-group col-md-4">
        <label for="platform-description">Alamat Konsumen</label>
        <textarea class="form-control mb-4" id="address" name="address" placeholder="" rows="5"></textarea>
    </div>
                
               <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">provinsi</label>
                    <div class="col-xl-10 col-lg-9 col-sm-10">  
                        <select onchange="getProv()" class="form-control select2" id="address_prov" name="address_prov">
                            @foreach ($data['provinces'] as $provinsi)
                    <option value="{{$provinsi->prov_id}}">{{$provinsi->prov_name}}</option> 

                    @endforeach

                        </select>

                    @csrf
                </div>
                <label for="exampleFormControlInput1">Kota</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                    <select onchange="getCity()" class="form-control select2" id="address_city" name="address_city">
                        <select class="form-control select2" id="address_city" name="address_city">
                   
                </select>

                
            </div>
            
            </div>

            <div class="form-group col-md-4">
                <label for="exampleFormControlInput1">Kecamatan</label>
                <div class="col-xl-10 col-lg-9 col-sm-10">
                <select class="form-control select2" id="address_kec" name="address_kec">
                   
                </select>

                @csrf
            </div>
            <label for="exampleFormControlInput1">Kode Pos</label>
            <div class="col-xl-10 col-lg-9 col-sm-10">
            <input type="text" class="form-control" id="postal_code" placeholder="" name="postal_code">

            @csrf
        </div>
        </div>

    <div class="form-group col-md-4">
        <label for="exampleFormControlInput1">Barang</label>
        <div class="col-xl-10 col-lg-9 col-sm-10">
            <select class="form-control select2" id="nama_barang" name="nama_barang">
                @foreach ($products as $product) 
                
                <option value="{{$product->product_id}}">{{$product->product_name}}-{{$product->product_model}}-{{$product->product_sku}}</option>


                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label for="exampleFormControlInput1">jumlah</label>
        <div class="col-xl-20 col-lg-10 col-sm-10">
            <input type="number" class ="form-control selectnum" id="quantity" name="quantity" min="1" max="100" >
        </div>
    </div>
    
    <div class="form-group col-md-4">
        <label for="exampleFormControlInput1">Note</label>
        <div class="col-xl-20 col-lg-10 col-sm-10">
            <input type="text" class ="form-control" id="notes" name="notes" placeholder="Resi Pengiriman" >
        </div>
    </div>    

    <div class="form-group col-md-4">
        {{-- <label for="hEmail">Note Pengiriman</label> --}}
        <div class="col-xl-10 col-lg-9 col-sm-10">
            <input type="hidden" class="form-control" id="type" placeholder="" name="type" value="pinjam">

       
    </div>
</div>
</div>

    <div class="form-group row">
        <div class="col-sm-12">
            <button type="button" class="tambah btn-primary" > Tambah </button>
        </div>
    </div>

           
        

          
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



                            </tbody>
                        </table>
                    </div>
                  <br>
                   <br>

                </div>
                <br>
               
                 <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="javascript:void" id="saveButton" class="btn btn-primary">Simpan</a>
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


    function getProv() {
       var clause = {fields:"prov_id",values:$("#address_prov").val()};
        $("#address_city").select2_modified({url:"{{url('/select2/get-raw')}}",label:'Pilih Kota',token:$("input[name='_token']").val(),field:"cities",id:"city_id",name:"city_name",clause:clause});
        // baris ketiga menunjukan nama tabel tujuan, baris kesatu menunjukan where nya
   }

   function getCity() {        
var clause = {fields:"city_id",values:$("#address_city").val()};
 $("#address_kec").select2_modified({url:"{{url('/select2/get-raw')}}",label:'Pilih Kecamatan',token:$("input[name='_token']").val(),field:"districts",id:"dis_id",name:"dis_name",clause:clause});
}

$("#saveButton").click(function() {
        var list_product_id = [];
        var list_product_name = [];
        var list_product_sku = [];
        var list_product_model = [];
        var list_quantity = [];

        $("input[name^=barang_ids]").each(function(){
            list_product_id.push($(this).val()) ;
        })
        $("input[name^=nama_barangs]").each(function(){
            list_product_name.push($(this).val()) ;
        })
        
        $(".models").each(function(){
            list_product_model.push($(this).text());
        })

        $(".skus").each(function(){
            list_product_sku.push($(this).text());
        })

        $(".jumlahs").each(function(){
            list_quantity.push($(this).text());
        })

formData = {
    'address_id': $("#address_id").val(),
    'borrow_name': $("#borrow_name").val(),
    'borrow_telepon': $("#borrow_telepon").val(),
    'pengiriman': $("#pengiriman").val(),
    'notes': $("#notes").val(),
    'address': $("#address").val(),
    'address_prov': $("#address_prov").val(),
    'address_city': $("#address_city").val(),
    'address_kec': $("#address_kec").val(),
    'postal_code': $("#postal_code").val(),
    'type': $("#type").val(),
    'borrow_invoice_id':generateInvoice(),
    'uid': generateUid(),
    'list_product_id':list_product_id,
    'list_product_name':list_product_name,
    'list_product_sku':list_product_sku,
    'list_product_model':list_product_model,
    'list_quantity':list_quantity,
    '_token': $("input[name='_token']").val()
}


$.ajax({
    url: "{{url('/pinjam/save')}}",
    method: 'POST',
    data: formData,
    cache: false,
    success: function(response) {
        response = JSON.parse(response);
        if (response.success == true) {
            alert('Simpan Data Berhasil');
            // location.reload();
        } else {
            alert("Gagal Menyimpan Data");
        }
    },
    error: function(error) {
        alert("Terjadi Kesalahan");
    }
});
});
function generateInvoice() {
    var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = mm + '' + dd + '' + yyyy;

    var d = new Date().getTime();
    var invoiceborr = 'PN/'+yyyy+'/'+mm+'/'+dd+'/xxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8));
    });
    return invoiceborr;
};

function generateUid() {
    var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = mm + '' + dd + '' + yyyy;

    var d = new Date().getTime();
    var uidpinjam = 'xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8));
    });
    return uidpinjam;
};

    </script>
    @endpush
