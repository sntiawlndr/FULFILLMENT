@extends('layout.app')

    
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                         <h4>Daftar Barang</h4>
                                        </div>                 
                                    </div>
                                </div>
                                
        
                                <div class="col-lg-12 layout-spacing">
                                    <div class="statbox widget box box-shadow">
                                        <div class="widget-header">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                    <h4></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                           <div class="form-group col-md-4">
                                    <label>Seller</label>            
                                   <select class="form-control select2" id="seller2" style="width: 200px" data-style="btn btn-outline-primary">
                                     <option value="">--Semua--</option>
                                    @foreach ($data['sellers'] as $seller)    
                        {{-- data jamak dijadikan satu  --}}
                        {{-- dibawah ini yg td diedit --}}
                        
                        <option value="{{$seller->user_id}}">{{$seller->name}}</option>
                        @endforeach
                                       
                                    </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="filter-satuan">Ukuran</label>
                                    <select class="form-control select2" style="width: 200px" data-style="btn btn-outline-primary" id="ukuran2">
                                        <option value="">--Semua--</option>
                                        <option value="s">S</option>
                                        <option value="m">M</option>
                                         <option value="l">L</option>
                                          <option value="xl">XL</option>

                                        
                                    </select>  
                                  </div>
                                  <div>

                                   <!-- printarea dari A Danu -->
                                   <div id="printarea">
                                    <style type="text/css">
                                    
                                    @media print {
                                        .jangan_print, #jangan_print, #jangan_print2 { visibility: hidden;  }
                                        #printarea { display:block !important; -webkit-print-color-adjust: exact; }
                                    
                                    
                                    
                                       .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4,.col-sm-4s, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
                                            float: left;
                                       }
                                       .col-sm-12 {
                                            width: 100%;
                                       }
                                       .col-sm-11 {
                                            width: 91.66666667%;
                                       }
                                       .col-sm-10 {
                                            width: 83.33333333%;
                                       }
                                       .col-sm-9 {
                                            width: 75%;
                                       }
                                       .col-sm-8 {
                                            width: 66.66666667%;
                                       }
                                       .col-sm-7 {
                                            width: 58.33333333%;
                                       }
                                       .col-sm-6 {
                                            width: 50%;
                                       }
                                       .col-sm-5 {
                                            width: 41.66666667%;
                                       }
                                       .col-sm-4 {
                                            width:75mm;
                                            height:38mm;
                                       }
                                       .col-sm-4s {
                                            width:75mm;
                                            height:38mm;
                                       }   
                                       .col-sm-3 {
                                            width: 25%;
                                       }
                                       .col-sm-2 {
                                            width: 16.66666667%;
                                       }
                                       .col-sm-1 {
                                            width: 8.33333333%;
                                       }
                                    
                                    
                                    }
                                    </style>
                                    <div class="box-body printarea" id="printarea" style="margin-top:0px;font-size:10px;max-width:250px">
                                       
                                        
                                    </div>
                                  </div>
                                  
                                                                      <!-- Akhir -->
                                    <!-- <div id="printArea">
                                         <svg id="barcode"></svg>
                                 </div> -->
                                  

                            
                        
                                  </div>
                                  {{-- <div class="form-group col-md-4">
                                  <span style="float:right;"><a href="{{url('/barang/filter')}}" class="btn btn-primary" style="margin-top:-10% height:5%;">Filter</a> </span> 
                                     <button type="button"  onclick="filter_id()" class="btn btn-primary chk" style="margin-top:-5% ">Filter</button>        --}}
                                  </div>
                                  </div>
                                  
                                  
                               </form>
                                <br>
                                
                                    {{-- form filter --}}
                                    
                                    <span style="float: right;">
                                    <select id='status2' class="form-control" style="width: 200px">
                                        <option value="">--Select Status--</option>
                                        <option value="enable">Enable</option>
                                        <option value="disable">Disable</option>
                                    </select>
                                    </span>
                                {{-- // --}}
                                {{-- <span style="float:right;"  class="btn btn-success" style="margin-top:-10% height:5%;" data-toggle="modal" data-target="#detailmodal">Cetak</a> </span>
                                <span style="float:right;"><a href="{{url('/barang/upload')}}" class="btn btn-info" style="margin-top:-10% height:5%;">Import CSV</a> </span>
                                <span style="float:right;"><a href="{{url('/barang/add')}}" class="btn btn-primary" style="margin-top:-10% height:5%;">Tambah</a> </span> --}}
                                <br>
                                <br>
                                <br>
                                <div class="widget-content widget-content-area">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-4" id="zero-config">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Seller</th>
                                                    <th>Kategori</th>
                                                    <th>Nama Barang</th>
                                                    <th>SKU</th>
                                                    <th>Ukuran</th>
                                                    <th>Status</th>
                                                    {{-- <th class="text-center" width="35%">Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>

                                               
                                                
                                            </tbody>
                                        </table>
                                    </div>



                                    <!-- Modal -->
<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="detailmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Print UID</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                      <div class="widget-content widget-content-area">
               <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-4">
                                            
                                                
                                               
                                            <div class="row" >
                                                <div class="col-md-9">
                                                    <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"></label>
                                                  <div class="row">
                                                    <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Jumlah</label>
                                                    <div class="col-8 col-sm-6">
                                                        <input type="number" class="form-control" name="jumcetakbar" id="jumcetakbar">
                                                    </div>
                                                    <div class="col-8 col-sm-3">
                                                       
                                                        <a  class="printPage" href="#">Printer</a>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>   
                                                    
                                                
                                            
                                        </table>
                                        
                                    </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

        <!-- modal -->
        <div class="modal fade" id="cetakmodal" tabindex="-1" role="dialog" aria-labelledby="cetakmodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Print UID</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                              <div class="widget-content widget-content-area">
                       <div class="table-responsive">
                                                <table class="table table-bordered table-striped mb-4">
                                                    <tbody class="cetak-detail">
                                                    </tbody>
                                                </table>
                                            </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
          <!-- modal -->

@endsection('content');
@push('jsfooter')
<script type="text/javascript">
var ss = $(".select2").select2({
        tags: true,
    });

    $("#jumcetakbar").change(function(){
        var jumlahcetak = $(this).val()
});

    $('#status2').change(function(){
    var status = $(this).val()
    if(status !== ""){
     load_data();
    }
     
    })
      $('#seller2').change(function(){
    var seller = $(this).val()
    if(seller !== ""){
     load_data();
    }
     
    })
      $('#ukuran2').change(function(){
    var ukuran = $(this).val()
    if(ukuran !== ""){
     load_data();
    }
     
    })

    
    
         
    $(document).ready(function(){
        load_data();
    })



    function load_data(){
        $('#zero-config').DataTable().destroy();
        
        $('#zero-config').DataTable( {
         "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{url('/barang/datatable')}}",
            "type": "POST",
            
            "data":{'_token':$("input[name='_token']").val(),'status':$('#status2 :selected').val(),'seller':$('#seller2 :selected').val(),'ukuran':$('#ukuran2 :selected').val()}
        },
        "columns":[ { "data": null,"sortable": false, 
       render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
    },
{data : "name"},
{data : "category_name"},
{data : "product_name"},
{data : "product_sku"},
{data : "size"},
{data : "product_status"},


// { data: null, render: function ( data, type, row ) {


//     let urledit = "{{URL::to('/')}}/barang/edit/"+data['product_id'];
//     let urldetail = "{{URL::to('/')}}/barang/detail/"+data['product_id'];

//     return '<a href="'+urldetail+'" class="btn btn-info"/>Detail</a> '
//     +'<a href="'+urledit+'" class="btn btn-primary"/>Edit</a> '
//     +"<a href='javascript:void(0)' onclick='delete_id("+data['product_id']+")' class='btn btn-danger'>Delete</a>";    
//            } },         
            ],

            "oLanguage": {
                
         "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page PAGE of PAGES",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  MENU",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50,100,500,1000],
            "pageLength": 5 
            
            
        });
    }

ter

function printbar(){
      
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})


}
function print_id(id){
      
      $.ajax({
                 url:"{{url('/barang/print')}}/"+id,
                 method: 'GET',
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(response) {
                     var data = JSON.parse(response);
                     var body ="";
                     if(data.content.length > 0){
                        $('#cetakmodal').modal('show');
                        val = data.content[0];
                        $(".cetak-detail").html(" ");
                        body += "<tr><td>Jumlah : <td></tr>"; 
                        body +=  "<tr><td>Cetak : <td></tr>"; 
                        // <input type="number" id="stepper1" name="stepper1" min="1" max="10" value="5" />
                        // <br /><br />
                        // <input type="button" onClick="saveValue('stepper1')" value="Submit" />                           
                        //  <div class="modal-footer">
                        //     <button type="button" class="btn btn-primary">Cetak</button>
                        // </div>                       
                         $(".cetak-detail").html(body);
                     }else{
                         alert("Data Barang Tidak Ditemukan") ;
                     }
                 },error: function (error) {
                         alert("Terjadi Kesalahan") ;       
                 }

            });
  
}




$('a.printPage').click(function(){
    
   var quantity= $('#jumcetakbar').val();
   var jumbar ='';
    for (let i = 0; i < quantity; i++) {
         
        jumlahbar= '<div ><svg id="barcode'+i+'"></svg></div>';
        $('#printarea').append(jumlahbar)

        JsBarcode("#barcode"+i, generateUUID(),{
                textAlign:"left",height:30,
                width:1,
                format:"CODE128",
                displayValue:true,
                fontSize:8});
        
   }


    newWin= window.open();
            var divToPrint = document.getElementById('printarea');
            newWin.document.write(divToPrint.innerHTML);

            newWin.document.close();
            newWin.focus();
            newWin.print();
          
           return false;
});
function generateDate(){
    var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = mm + '' + dd + '' + yyyy;

}

function generateUUID() {
    var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = mm + '' + dd + '' + yyyy;

    var d = new Date().getTime();
    var uuid = 'GM'+yyyy+mm+dd+'xxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8));
    });
    return uuid;
};






 
</script>
@endpush