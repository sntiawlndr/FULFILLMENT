@extends('layout.app')
{{-- <script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
           
            var uidi = $("#scan").text();
            // var nm_brg = $("#nm_brg option:selected").val();
            var markup = "<tr><td></td><td><input type='text' name='uidis' value='"+uidi+"' readonly></td></tr>";
            $("table tbody").append(markup);
        });
        // <input type='text' name='nama_barangs' value='"+nm_brg+"'
        // Find and remove selected table rows
       


       
    });    
</script> --}}
@section('content')
<div id="tableStriped" class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Terima Barang Lama
                        <a href="{{url('/lama')}}" class="btn btn-dark" style="float:right;margin-top: -1%;color:#fff;">Kembali</a>
                    </h4>
                </div>
            </div>
        </div>
        <form>
            <div class="widget-content widget-content-area">
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
                        <input type="text" class="form-control" name="scan" id ="scan2"
                          >
                    </div>
                    
                    <div>
                    {{-- <input type="submit" id="myBtn" value="Submit"> --}}
                    </div>
                    {{-- value="{{$tbb->no_invoice}}" --}}
                    {{-- @endforeach --}}

            
                </div>

                <br>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-4" id="zero-config" >
                            <thead>
                                <tr>                                    
                                    <th>UID</th>
                                    <th>Nama Barang</th>
                                </tr>
                            </thead>
                            {{-- <tbody id="zero"></tbody> ID Buat Scan--}}
                            <tbody id="zero">
                                @foreach ($data['tbl'] as $data)
                                    
                                <tr>
                                <td><input type="text" value="{{$data->uid}}"></td>                               
                                <td><input type="text" value="{{$data->product_name}}"></td>
                                </tr>
                                @endforeach
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




<!-- Modal -->
<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="detailmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Terima Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
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
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
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
//Scan 
$("#scan2").keypress(function(e){

if(e.keyCode==13)

{
  
            var uidi = $("#scan2").val();
            var nama_barang = $("#scan2 option:selected").text();
            var nm_brg = uidi.split("-")[0];
            var markup = "<tr><td></td><td><input type='text' class='uidis' value='"+uidi+"' readonly>'</td><td><input type='text' class='nm_brgs' value='"+nm_brg+"' readonly>'</td></tr>";
            $("#zero").append(markup);
            
}

})

// function cek(id) {

//             $.ajax({
//                 url: "{{url('/tbl/cek')}}/" + id,
//                 method: 'GET',
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 success: function (response) {
//                      response = JSON.parse(response);
//         if (response.success == true) {
//             alert('Show Berhasil');
//             // location.reload();
//         } else {
//             alert("Gagal Show Data");
//         }
//     },
//     error: function(error) {
//         alert("Terjadi Kesalahan");
//     }
// });
// });

 
// $("#saveButton").click(function() {
//         var list_uid = [];       
//         $(".uidis").each(function(){
//             list_uid.push($(this).text());
//         })
// formData = {
//     'list_uid':list_uid,
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
$("#saveButton").click(function() {

formData = {
    'uid': $("#uid").val(),
    'product_name': $("#product_name").val(),
    '_token': $("input[name='_token']").val()
}


$.ajax({
    url: "{{url('/tbl/update')}}",
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

// $(document).ready(function(){  
//       function autoSave()  
//       {  
         
//            var autosave = $('#autosave').val();  
//            if(autosave != '')  
//            {  
//                 $.ajax({  
//                      url:"{{url('tbl/save')}}",  
//                      method:"POST",  
//                      data:{autoSave:autosave},  
//                      dataType:"text",  
//                      success:function(data)  
//                      {  
//                           if(data != '')  
//                           {  
//                                $('#autosave').val(data);  
//                           }  
//                           $('#autosave').text("Post save as draft");  
//                           setInterval(function(){  
//                                $('#autosave').text('');  
//                           }, 5000);  
//                      }  
//                 });  
//            }            
//       }  
//       setInterval(function(){   
//         autosave();   
//            }, 10000);  
//  });  

    

    // $(document).ready(function () {
    //     load_data();
    // })

    // function load_data() {
    //     $('#zero-config').DataTable().destroy();
    //     $('#zero-config').DataTable({
    //         "processing": true,
    //         "serverSide": true,
    //         "ajax": {
    //             "url": "{{url('/tbl/datatable')}}",
    //             "type": "POST",
    //             "data": {
    //                 '_token': $("input[name='_token']").val()
    //             }
    //         },
    //         "columns": [ { "data": null,"sortable": false, 
    //    render: function (data, type, row, meta) {
    //              return meta.row + meta.settings._iDisplayStart + 1;
    //             }  
    // },
    //             {
    //                 data: "uid"
    //             },
    //             {
    //                 data: "product_name"
    //             },


    //             // { data: null, render: function ( data, type, row ) {



    //             //     return '<a href="{{url('lama')}}" class="btn btn-primary"/>Batal</a> ';  
    //             //            } },         
    //         ],

    //         "oLanguage": {

    //             "oPaginate": {
    //                 "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
    //                 "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
    //             },
    //             "sInfo": "Showing page PAGE of PAGES",
    //             "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
    //             "sSearchPlaceholder": "Search...",
    //             "sLengthMenu": "Results :  _MENU_",
    //         },
    //         "stripeClasses": [],
    //         "lengthMenu": [5, 10, 20, 50, 100, 500, 1000],
    //         "pageLength": 5


    //     });
    // }

    function delete_id(id) {
        var ask = ("Are Sure?");
        if (ask) {


            $.ajax({
                url: "{{url('/barang/delete')}}/" + id,
                method: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert("Hapus Data berhasil");
                    load_data();
                },
                error: function (error) {
                    alert("Hapus Data Gagal");
                }
            });
        }
    }

    function detail_id(id) {

        $.ajax({
            url: "{{url('/barang/print')}}/" + id,
            method: 'GET',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                var data = JSON.parse(response);
                var body = "";
                if (data.content.length > 0) {
                    $('#detailmodal').modal('show');
                    val = data.content[0];
                    $(".list-detail").html(" ");
                    body += "<tr><td>ID : <td><td>" + val.product_id + "<td></tr>";
                    body += "<tr><td>seller id: <td><td>" + val.seller_id + "<td></tr>";
                    body += "<tr><td>nama barang: <td><td>" + val.product_name + "<td></tr>";
                    body += "<tr><td>SKU: <td><td>" + val.product_sku + "<td></tr>";
                    body += "<tr><td>ukuran : <td><td>" + val.size + "<td></tr>";
                    $(".list-detail").html(body);
                } else {
                    alert("Barang Detail Tidak Ditemukan");
                }
            },
            error: function (error) {
                alert("Terjadi Kesalahan");
            }
        });

    }

    function print_id(id) {

        $.ajax({
            url: "{{url('/baru/print')}}/" + id,
            method: 'GET',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                var data = JSON.parse(response);
                var body = "";
                if (data.content.length > 0) {
                    $('#cetakmodal').modal('show');
                    val = data.content[0];
                    $(".cetak-detail").html(" ");
                    body += "<tr><td>Jumlah : <td></tr>";
                    // <input type="number" id="stepper1" name="stepper1" min="1" max="10" value="5" />
                    // <br /><br />
                    // <input type="button" onClick="saveValue('stepper1')" value="Submit" />                           
                    //  <div class="modal-footer">
                    //     <button type="button" class="btn btn-primary">Cetak</button>
                    // </div>                       
                    $(".cetak-detail").html(body);
                } else {
                    alert("Data Barang Tidak Ditemukan");
                }
            },
            error: function (error) {
                alert("Terjadi Kesalahan");
            }
        });
    }
    $("#saveButton").click(function() {
        var list_uidis = [];
        var list_nm_brgs = [];
        
        $(".uidi").each(function(){
            list_uidis.push($(this).text());
        })

        $(".nm_brg").each(function(){
            list_nm_brgs.push($(this).text());
        })



formData = {
    'list_uidi':list_uidis,
    'list_nm_brg':list_nm_brgs,
    '_token': $("input[name='_token']").val()
}


$.ajax({
    url: "{{url('/tbl/save')}}",
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

</script>
@endpush