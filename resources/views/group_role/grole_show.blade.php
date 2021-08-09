@extends('layout.app')
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                         <h4>Role 
                                            <span style="float:right;"><a href="{{url('/grole/add')}}" class="btn btn-primary" style="margin-top:-10%;">Tambah</a> </span></h4>
                                            
                                        </div>                 
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-4" id="zero-config">
                                            <thead>
                                                <tr>
                                                    
                                                    
                                                    <th>No </th>
                                                    <th>Nama Role</th>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">grole Detail</h5>
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
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="formData" name="formData" class="form-horizontal">
                           <input type="hidden" name="Customer_id" id="Customer_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                 <select class="selectpicker form-control" id="group_status" class="form-control" name="group_status">
        
                                        <option if="" ($status="=" 1="" )="" echo="" 'selected'="" ;="" ?="">Enable</option>
        
                                        <option if="" ($status="=" 2="" )="" echo="" 'selected'="" ;="" ?="">Disable</option>
        
        
                                    </select>
                                </div>
                            </div>
        
                            
        
                            <div class="col-sm-offset-2 col-sm-10">
                             <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                             </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                             

        

        {{-- modal Tambah --}}
        {{-- <div class="modal fade" id="tambah" >
            <div class="modal-dialog">
              <div class="modal-content">
                 <form enctype="multipart/form-data" action="proses_tambah_poliklinik.php" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Tambah Role</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group col-md-6">
                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Nama</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                            <input type="text" class="form-control" id="group_name" placeholder="" name="group_name" required>
                            @csrf
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Status</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                         <select class="selectpicker form-control" id="group_status" class="form-control" name="group_status">

                                <option if="" ($status="=" 1="" )="" echo="" 'selected'="" ;="" ?="">Enable</option>

                                <option if="" ($status="=" 2="" )="" echo="" 'selected'="" ;="" ?="">Disable</option>


                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-default" name="action" value="Simpan">
                </div>
              </form>
              </div>
            </div>
        </div>
         --}}
       
        {{-- modal --}}

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
            "url": "{{url('/grole/datatable')}}",
            "type": "POST",
            "data":{'_token':$("input[name='_token']").val()}
        },
         "columns":[ { "data": null,"sortable": false, 
       render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
    },
                 
{data : "group_name"},
{data : "group_status"},


{ data: null, render: function ( data, type, row ) {


    let urledit = "{{URL::to('/')}}/grole/edit/"+data['group_role_id'];
    
     var btn =  '<a href="'+urledit+'" class="btn btn-primary"/>Edit</a> ';
    btn = btn +'<a href="javascript:void(0)" class="btn btn-info" onclick="detail_id('+data['group_role_id']+')">Detail</a> ';
    if (data['group_status']=='disable'){
        btn= btn+"<a href='javascript:void(0)' onclick='unsuspend_id("+data['group_role_id']+")' class='btn btn-danger'>Unsuspend</a>";
    }else{
        btn = btn+ "<a href='javascript:void(0)' onclick='suspend_id("+data['group_role_id']+")' class='btn btn-danger'>Suspend</a>";
    }
   
    btn=btn +"<a href='javascript:void(0)' onclick='delete_id("+data['group_role_id']+")' class='btn btn-danger'>Delete</a>";
       return btn;     
           } },         
            ],

            "oLanguage": {
                
         "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
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
    var ask = confirm("Apakah Anda Yakin?");
    if(ask){
    
  
     $.ajax({
                url:"{{url('/grole/delete')}}/"+id,
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
function suspend_id(id){
    var ask = confirm("Suspend ?");
    if(ask){
    
  
     $.ajax({
                url:"{{url('/grole/suspend')}}/"+id,
                method: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert("Suspend Data berhasil");
                    load_data();
                },error: function (error) {
                     alert("Suspend Data Gagal");          
                }
           });
    }
}
function unsuspend_id(id){
    var ask = confirm("Unsuspend ?");
    if(ask){
    
  
     $.ajax({
                url:"{{url('/grole/unsuspend')}}/"+id,
                method: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert("Unsuspend Data berhasil");
                    load_data();
                },error: function (error) {
                     alert("unsuspend Data Gagal");          
                }
           });
    }
}



function detail_id(id){
      
     $.ajax({
                url:"{{url('/grole/get')}}/"+id,
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
                       body += "<tr><td>ID : <td><td>"+val.group_role_id+"<td></tr>";
body += "<tr><td>Nama Kategori : <td><td>"+val.group_name+"<td></tr>";
body += "<tr><td>group Status : <td><td>"+val.group_status+"<td></tr>";
    
    $(".list-detail").html(body);
                    }else{
                        alert("group_role Detail Tidak Ditemukan") ;
                    }
                },error: function (error) {
                        alert("Terjadi Kesalahan") ;       
                }
           });
//tambahan untuk modal Creat
        $('#createNewCustomer').click(function () {
        $('#saveBtn').val("create-Customer");
        
        $("#group_name").val(),
        $("#group_status").val(),
        $('#formData').trigger("reset");
        $('#modelHeading').html("Create New Customer");
        $('#ajaxModel').modal('show');
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#formData').serialize(),
          url: "{{url('/grole/save')}}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#formData').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

           

}
</script>
@endpush