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
                                    <label>Seller</label>            
                                    <select class="selectpicker mb-4 ml-3 saring" data-style="btn btn-outline-primary">
                                        <option>Semua(Select2)</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                        <option>Onions</option>
                                    </select>
                                    
                                    <label for="filter-satuan">Ukuran</label>
                                    <select data-column="1" class="selectpicker mb-4 ml-3 filter" data-style="btn btn-outline-info" id="status">
                                        <option value="">Semua</option>
                                        <option value="s">S</option>
                                        <option value="m">M</option>
                                        
                                    </select>         
                                
                                </form>
                                <br>
                                 
                                    {{-- form filter --}}
                                    <span style="float: right;">
                                    <select id='status' class="form-control" style="width: 200px">
                                        <option value="">--Select Status--</option>
                                        <option value="enable">Enable</option>
                                        <option value="disable">Disable</option>
                                    </select>
                                    </span>

                               
                                <span style="float:right;"><a href="{{url('/barang/upload')}}" class="btn btn-info" style="margin-top:-10% height:5%;">Import CSV</a> </span>
                                <span style="float:right;"><a href="{{url('/barang/add')}}" class="btn btn-primary" style="margin-top:-10% height:5%;">Tambah</a> </span>
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
                                                    <th class="text-center" width="35%">Action</th>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Barang Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                      <div class="widget-content widget-content-area">
               <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-4">
                                            <tbody class="list-detail">
                                            </tbody>
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
  $(function () {
      
    var table = $('#zero-config').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('barang.fildown') }}",
          data: function (d) {
                d.status = $('#status').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'product_id', name: 'product_id'},
            {data: 'seller_name', name: 'seller_name'},  
            {data: 'category_name', name: 'category_name'},            
            {data: 'product_name', name: 'product_name'},  
            {data: 'product_sku', name: 'product_sku'}, 
            {data: 'size', name: 'size'},
            {data: 'status', name: 'status'},
            { data: null, render: function ( data, type, row ) {


let urledit = "{{URL::to('/')}}/barang/edit/"+data['product_id'];
let urldetail = "{{URL::to('/')}}/barang/detail/"+data['product_id'];

    return '<a href="'+urldetail+'" class="btn btn-info"/>Detail</a> '
    +'<a href="'+urledit+'" class="btn btn-primary"/>Edit</a> '
    +"<a href='javascript:void(0)' onclick='delete_id("+data['product_id']+")' class='btn btn-danger'>Delete</a>"
    +'<a href="javascript:void(0)" class="btn btn-success" onclick="print_id('+data['product_id']+')">Print</a> '; 
        
       } }, 
         
        ]
    });
  
    $('#status').change(function(){
        table.draw();
    });
      
  });



    

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

 
</script>
@endpush