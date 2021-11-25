@extends('layout.app')
@section('content')
<img id="barcode">
{{-- <span onclick="cetak()" class="btn btn-success" > Print</a> </span> --}}
@endsection('content');
@push('jsfooter')

<script type="text/javascript">
    
  JsBarcode("#barcode", "test",{
                textAlign:"left",height:30,
                width:1,
                format:"CODE128",
                displayValue:true,
                fontSize:8});
                


 
</script>
@endpush