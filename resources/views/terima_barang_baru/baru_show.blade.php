@extends('layout.app')
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                         <h4>Daftar Terima Barang</h4>
                                        </div>                 
                                    </div>
                                </div>
                                {{--  --}}
                           <!-- printarea dari A Danu -->
                           <br>
                           <br>
                        
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
                                <br>
                                  {{-- <!-- printarea dari A Danu -->
                                  
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
                                  </div> --}}
                                  
                                                                      <!-- Akhir -->
                                    <!-- <div id="printArea">
                                         <svg id="barcode"></svg>
                                 </div> -->
                                  

                                <div class="widget-content widget-content-area">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-4" id="zero-config">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Invoice</th>
                                                    <th>Seller</th>
                                                    <th>Total Jumlah</th>
                                                    <th class="text-center" width="35%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
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
                                                        {{-- <span class="btn btn-success" id="printbarcode" ><a href="{{ route('printbar')}}"> Print</a> </span> --}}
                                                        <a  class="printPage btn btn-primary" button type="button"  href="#">Printer</a>
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

    $(document).ready(function(){
        load_data();
    })

    function load_data(){
        $('#zero-config').DataTable().destroy();
        $('#zero-config').DataTable( {
         "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{url('/baru/datatable')}}",
            "type": "POST",
            "data":{'_token':$("input[name='_token']").val()}
        },
         "columns":[ { "data": null,"sortable": false, 
       render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
    },
{data : "no_invoice"},
{data : "name"},
{data : "amount"},


{ data: null, render: function ( data, type, row ) {


    let urledit = "{{URL::to('/')}}/terima/baru/"+data['order_id'];
    return '<a href="'+urledit+'" class="btn btn-primary"/>Terima Barang</a>';  
           } },         
            ],

            "oLanguage": {
                
         "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page PAGE of PAGES",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50,100,500,1000],
            "pageLength": 5 
            

        });
    }

function delete_id(id){
    var ask = ("Are Sure?");
    if(ask){
    
  
     $.ajax({
                url:"{{url('/barang/delete')}}/"+id,
                method: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert("Hapus Data berhasil");
                    load_data();
                },error: function (error) {
                     alert("Hapus Data Gagal");          
                }
           });
    }
}

function detail_id(id){
      
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
                       $('#detailmodal').modal('show');
                       val = data.content[0];
                       $(".list-detail").html(" ");
                       body += "<tr><td>ID : <td><td>"+val.product_id+"<td></tr>";
body += "<tr><td>seller id: <td><td>"+val.seller_id+"<td></tr>";
body += "<tr><td>nama barang: <td><td>"+val.product_name+"<td></tr>";
body += "<tr><td>SKU: <td><td>"+val.product_sku+"<td></tr>";
body += "<tr><td>ukuran : <td><td>"+val.size+"<td></tr>";   
    $(".list-detail").html(body);
                    }else{
                        alert("Barang Detail Tidak Ditemukan") ;
                    }
                },error: function (error) {
                        alert("Terjadi Kesalahan") ;       
                }
           });

}
// function print_id(id){
      
//       $.ajax({
//                  url:"{{url('/baru/print')}}/"+id,
//                  method: 'GET',
//                  cache: false,
//                  contentType: false,
//                  processData: false,
//                  success: function(response) {
//                      var data = JSON.parse(response);
//                      var body ="";
//                      if(data.content.length > 0){
//                         $('#cetakmodal').modal('show');
//                         val = data.content[0];
//                         $(".cetak-detail").html(" ");
//                         body += "<tr><td>Jumlah : <td></tr>"; 
//                         body +=  "<tr><td>Cetak : <td></tr>"; 
//                         <input type="number" id="stepper1" name="stepper1" min="1" max="10" value="5" />
//                         <br /><br />
//                         <input type="button" onClick="saveValue('stepper1')" value="Submit" />                           
//                          <div class="modal-footer">
//                             <button type="button" class="btn btn-primary">Cetak</button>
//                         </div>                       
//                          $(".cetak-detail").html(body);
//                      }else{
//                          alert("Data Barang Tidak Ditemukan") ;
//                      }
//                  },error: function (error) {
//                          alert("Terjadi Kesalahan") ;       
//                  }
//             });
    
    $('a.printPage').click(function(){
    
    var quantity= $('#jumcetakbar').val();
    var jumbar ='';
     for (let i = 0; i < quantity; i++) {
          
         jumlahbar= '<div ><svg id="barcode'+i+'"></svg></div>';
         $('#printarea').append(jumlahbar)
 
         JsBarcode("#barcode"+i,generateUUID(),{
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
// function generateDate(){
// var today = new Date();
// var dd = String(today.getDate()).padStart(2, '0');
// var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
// var yyyy = today.getFullYear();

// today = mm + '' + dd + '' + yyyy;

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