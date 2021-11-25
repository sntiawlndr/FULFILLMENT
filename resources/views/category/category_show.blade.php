@extends('layout.app')
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                         <h4>Category 
                                            <span style="float:right;"><a href="{{url('/category/add')}}" class="btn btn-primary" style="margin-top:-10%;">Tambah</a> </span></h4>
                                        </div>                 
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    {{-- form filter --}}
                                    <span style="float: right;">
                                    <select id='category_status' class="form-control" style="width: 200px">
                                        <option value="">--Select Category_status--</option>
                                        <option value="enbale">Enable Only</option>
                                        <option value="disable">Disabled</option>
                                    </select>
                                    </span>
                                    {{-- // --}}
                                    <div class="table-responsive">
                                        {{-- id atau class ini penting untuk di panggil di variable function javascript nya --}}
                                        <table class="table table-bordered table-striped mb-4" id="zero-config">
                                            <thead>
                                                <tr>
                                                    <th>Id Category </th>
                                                    <th>Nama Category </th>
                                                   
                                                    <th>Category_status </th>
                                                    
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
                <h5 class="modal-title" id="exampleModalCenterTitle">category Detail</h5>
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

@endsection('content');
@push('jsfooter')
<script type="text/javascript">
  $(function () {
      
    var table = $('#zero-config').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('category.fildown') }}",
          data: function (d) {
                d.category_status = $('#category_status').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'category_id', name: 'category_id'},
            {data: 'category_name', name: 'category_name'},
            
            {data: 'category_status', name: 'category_status'},
            { data: null, render: function ( data, type, row ) {


let urledit = "{{URL::to('/')}}/category/edit/"+data['category_id'];

return '<a href="'+urledit+'" class="btn btn-primary"/>Edit</a> '
+'<a href="javascript:void(0)" class="btn btn-info" onclick="detail_id('+data['category_id']+')">Detail</a> '
+"<a href='javascript:void(0)' onclick='delete_id("+data['category_id']+")' class='btn btn-danger'>Delete</a>";
        
       } }, 
            
        ]
    });
  
    $('#category_status').change(function(){
        table.draw();
    });
      
  });


    

function delete_id(id){
    var ask = ("Are Sure?");
    if(ask){
    
  
     $.ajax({
                url:"{{url('/category/delete')}}/"+id,
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

  
</script>
@endpush
