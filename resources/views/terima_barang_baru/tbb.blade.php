@extends('layout.app')
@section('content')

<br>
                            <div id="tabsSimple" class="col-lg-7  col md-6 col-7 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-10 col-md-6 col-sm-10 col-10">
                                            <h4>Terima Barang Baru
                                                <a href="{{url('/baru')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row mb-4">
                                    <label for="hNomorPenerimaan" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nomer
                                        Penerimaan</label>
                                    {{-- @foreach ($data['tbbs'] as $tbb) --}}
                                    {{-- <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" class="form-control" name="no_invoice" autocomplete="off" readonly=""
                                            id="no_invoice" value="{{$ventory->no_invoice}}" >
                                            
                                    </div> --}}
                                </div>
                                <label href="javascript:void" for="hScan" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"  placeholder="To enter">Scan Barcode UID</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="scan" id ="scan2" >
                                </div>
                                {{-- <label href="javascript:void" for="hScan" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"  placeholder="To enter">Scan Barcode SUMMARY</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control" name="scan" id ="scan3" >
                                </div> --}}
                                <br>
                                <div class="widget-content widget-content-area simple-tab">
                                    <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Summary</a>
                                        </li>
                                
                                    </ul>
                                    <div class="tab-content" id="simpletabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="table-responsive">
                                                <form id="form-tbb">
                                                    @csrf                                                    
                                                    <input type="hidden" name="order_id" value="{{$data['baru'][0]->order_id}}">
                                                    <table class="table table-bordered table-striped mb-4">
                                                        <thead>
                                                            <tr>
                                                                <th>UID</th>
                                                                <th>Nama Barang</th>  
                                                                <th href="javascript:void" onclick="bttn_btl()" id="btl" class="text-center"  width="35%">Action</th>
                                                           
                                                            </tr>
                                                        </thead>
                                                        <tbody id="zero">                                                    
                                                                {{-- @foreach ($data['tbb'] as $data)
                                                                <tr>
                                                                    <td><input type="text" value="{{$data->uid}}"></td>                               
                                                                    <td><input type="text" value="{{$data->product_name}}"></td>
                                                                    <td><button type="button" class="btn btn-sm btn-primary" href="javascript:void" onclick="bttn_btl({{$data->order_detail_id}})" id="{{$data->order_detail_id}}">Batal</button></td>
                                                                </tr>
                                                                @endforeach                                                     --}}
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="table-responsive">
                                             <table class="table table-bordered table-striped mb-4">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Nama Barang</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody id="first">                                            
                                                    {{-- @foreach ($data['tbb'] as $data)                                                        
                                                    <tr>
                                                    <td><input type="text" value="{{$data->product_name}}"></td>                               
                                                    <td><input type="text" value="{{$data->quantity}}"></td>
                                                    </tr>
                                                    @endforeach                                                 --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <button href="javascript:void" type="button" id="saveButton" class="btn btn-primary"
                                        data-dismiss="modal">Simpan</button>
                                </div>
                            </div>
                    </div>
                </div>
                </div>

                </div>
                </div>
                </div>

                </div>
                </form>
                        
                        
    @endsection('content')

    @push('jsfooter')
    <script type="text/javascript">
    $("#scan2").keypress(function(e){

if(e.keyCode==13)

{
    let scan_uid = $(this).val()
    
    $.ajax({
        url: "{{url('/baru/scan')}}",
        method: 'POST',
        "data":{'_token':$("input[name='_token']").val(), uid:scan_uid },
        
        success: function (response) {
            data = response.data.detail
            
            var markup = "<tr><td><input type='text' class='uidis' name='uid[]' value='"+data.uid+"' readonly>'</td><td><input type='text' name='product_name[]' class='uidis' value='"+data.product_name+"' readonly></td><td><button type='button' class='btn btn-sm btn-primary' href='javascript:void(0)' onclick=bttn_btl('"+data.order_detail_id+"') id='"+data.order_detail_id+"'>Batal</button></td></tr>";
            $("#zero").append(markup);

            // var markdown = "<tr><td></td><td><input type='text' class='nambar' value='"+namabrg+"' readonly>'</td><td><input type='text' class='qty' value='"+quant+"' readonly>'</td></tr>";
            // $("#first").append(mardown);

            // response = JSON.parse(response);
            // if (response.success == true) {
            //     alert('Simpan Data Berhasil');
            //     location.reload();
            // } else {
            //     alert("Gagal Menyimpan Data");
            // }
        },
        error: function (error) {
            alert("Terjadi Kesalahan");
        }
    });
        // var uidi = $("#scan2").val();
        // var nama_barang = $("#scan2 option:selected").text();
        
    
        // var nm_brg = uidi.split("-")[0];
        
        // var markup = "<tr><td></td><td><input type='text' class='uidis' value='"+uidi+"' readonly>'</td><td><input type='text' class='uidis' value='"+nm_brg+"' readonly>'</td></tr>";
        // $("#zero").append(markup);
        // var markdown = "<tr><td></td><td><input type='text' class='nambar' value='"+namabrg+"' readonly>'</td><td><input type='text' class='qty' value='"+quant+"' readonly>'</td></tr>";
        // $("#first").append(mardown);
            
}

})

// $("#scan3").keypress(function(e){

// if(e.keyCode==13)

// {
  
//             var namabrg = $("scan3").val();
//             var nama_brg = $("#scan3 option:selected").text();          
        
//             var quant = quant.split("-")[0];
//             var markdown = "<tr><td></td><td><input type='text' class='nambar' value='"+namabrg+"' readonly>'</td><td><input type='text' class='qty' value='"+quant+"' readonly>'</td></tr>";
//             $("#first").append(mardown);
            
// }

// })


     $("#saveButton").click(function () {
        

        $.ajax({
            url: "{{url('/tbb/save')}}",
            method: 'POST',
            data : $('#form-tbb').serialize(),
            success: function (response) {
                response = JSON.parse(response);
                if (response.success == true) {
                    // location.reload();
                    alert('Simpan Data Berhasil');
                } else {
                    alert("Gagal Menyimpan Data");
                }
            },
            error: function (error) {
                alert("Terjadi Kesalahan");
            }
        });
    });

function bttn_btl(id){
    var ask = ("Are Sure?");
    if(ask){
        elm = $('#'+id)
        row = elm.parent().parent().remove()
        
  
     $.ajax({
                url:"{{url('/tbb/batal')}}/",
                method: 'POST',
                "data":{'_token':$("input[name='_token']").val(), id:id },
                success: function(response) {
                    alert("Batalkan Data berhasil");
                    load_data();
                },error: function (error) {
                     alert("Gagal Batalkan Data");          
                }
           });
    }
}
   
// $(document).ready(function(){
//     load_data();
// })

// function load_data(){
//     $('#zero-config').DataTable().destroy();
//     $('#zero-config').DataTable( {
//      "processing": true,
//     "serverSide": true,
//     "ajax": {
//         "url": "{{url('/tbb/datatable')}}",
//         "type": "POST",
//         "data":{'_token':$("input[name='_token']").val()}
//     },
//      "columns":[

// {data : "uid"},
// {data : "product_name"},
// { data: null, render: function ( data, type, row ) {



// return '<a href="{{url('baru')}}" class="btn btn-primary"/>Batal</a> ';  
//    } },
     
//         ],

//         "oLanguage": {
            
//      "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
//             "sInfo": "Showing page PAGE of PAGES",
//             "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
//             "sSearchPlaceholder": "Search...",
//            "sLengthMenu": "Results :  _MENU_",
//         },
//         "stripeClasses": [],
//         "lengthMenu": [5, 10, 20, 50,100,500,1000],
//         "pageLength": 5 
        

//     });
// }
// $(document).ready(function(){
//     tampil_data();
// })

// function tampil_data(){
//     $('#a-config').DataTable().destroy();
//     $('#a-config').DataTable( {
//      "processing": true,
//     "serverSide": true,
//     "ajax": {
//         "url": "{{url('/summary/datatable')}}",
//         "type": "POST",
//         "data":{'_token':$("input[name='_token']").val()}
//     },
//      "columns":[

// {data : "product_name"},
// {data : "quantity"},

//         ],

//         "oLanguage": {
            
//      "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
//             "sInfo": "Showing page PAGE of PAGES",
//             "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
//             "sSearchPlaceholder": "Search...",
//            "sLengthMenu": "Results :  _MENU_",
//         },
//         "stripeClasses": [],
//         "lengthMenu": [5, 10, 20, 50,100,500,1000],
//         "pageLength": 5 
        

//     });
// }


// $("#saveButton").click(function() {
//         var list_uidis = [];
//         var list_nm_brgs = [];
        
//         $(".uidi").each(function(){
//             list_uidis.push($(this).text());
//         })

//         $(".nm_brg").each(function(){
//             list_nm_brgs.push($(this).text());
//         })



// formData = {
//     'list_uidi':list_uidis,
//     'list_nm_brg':list_nm_brgs,
//     '_token': $("input[name='_token']").val()
// }


// $.ajax({
//     url: "{{url('/tbl/save')}}",
//     method: 'POST',
//     data: formData,
//     cache: false,
//     success: function(response) {
//         response = JSON.parse(response);
//         if (response.success == true) {
//             alert('Simpan Data Berhasil');
//             // location.reload();
//         } else {
//             alert("Gagal Menyimpan Data");
//         }
//     },
//     error: function(error) {
//         alert("Terjadi Kesalahan");
//     }
// });
// });

    </script>
    @endpush
