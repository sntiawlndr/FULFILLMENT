<html>
<head>
<title>Simple jQuery Barcode Generator</title>
<head>

<style>
#barcodeTarget,  #canvasTarget {
margin-top: 20px;
}
</style>	
	
<link href="style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>
<script type="text/javascript" src="jquery-barcode.min.js"></script>

<script type="text/javascript">
    
      function generateBarcode(){
        var value = $("#barcodeValue").val();
        var btype = $('select[name="btype"]').val();
        var renderer = $('select[name="renderer"]').val();
        
		
        var settings = {
          output:renderer,
          bgColor: '#FFFFFF',
          color: '#000000',
          barWidth: '1',
          barHeight: '50',
          moduleSize: '5',
          posX: '10',
          posY: '20',
          addQuietZone: '1'
        };
        
        if (renderer == 'canvas'){
          clearCanvas();
          $("#barcodeTarget").hide();
          $("#canvasTarget").show().barcode(value, btype, settings);
        } else {
          $("#canvasTarget").hide();
          $("#barcodeTarget").html("").show().barcode(value, btype, settings);
        }
      }
          
      function showConfig1D(){
        $('.config .barcode1D').show();
        $('.config .barcode2D').hide();
      }
      
      function showConfig2D(){
        $('.config .barcode1D').hide();
        $('.config .barcode2D').show();
      }
      
      function clearCanvas(){
        var canvas = $('#canvasTarget').get(0);
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 1;
        ctx.lineCap = 'butt';
        ctx.fillStyle = '#FFFFFF';
        ctx.strokeStyle  = '#000000';
        ctx.clearRect (0, 0, canvas.width, canvas.height);
        ctx.strokeRect (0, 0, canvas.width, canvas.height);
      }
      
      $(function(){
        $('input[name=btype]').click(function(){
          if ($(this).attr('id') == 'datamatrix') showConfig2D(); else showConfig1D();
        });
        $('input[name=renderer]').click(function(){
          if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
        });
        generateBarcode();
      });
  
    </script>

</head>
<body>
<div align="center">
	<h2>jQuery Barcode Generator Example</h2>
	<div class="frmContact">
        <div class="field-row">
            <label>Fill The Code</label> <span class="info"></span>
            <br /> 
            <input type="text" id="barcodeValue" value="19851106" class="input_box">
        </div>
        <div class="field-row">
            <div class="contact-row column-right">
                <label>Barcode Type</label> 
                <span class="info"></span>
                <br /> 
                <select name="btype" class="select_box">
                <option value="ean8">EAN 8</option>
				<option value="ean13">EAN 13</option>
				<option value="upc">UPC</option>
				<option value="std25">standard 2 of 5 (industrial)</option>
				<option value="int25">interleaved 2 of 5</option>
				<option value="code11">code 11</option>
				<option value="code39">Code 39</option>
				<option value="code93">code 93</option>
				<option value="code93">code 93</option>
				<option value="code128">code 128</option>
				<option value="codabar">codabar</option>
				<option value="msi">MSI</option>
				<option value="datamatrix">Data Matrix</option>
                </select> 
                
                
            </div>
            <div class="contact-row cvv-box">
                <label>Format</label> <span class="info"></span><br />
                <select name="renderer" class="select_box">
				<option value="css">CSS</option>
				<option value="bmp">BMP (not usable in IE)</option>
				<option value="svg">SVG (not usable in IE)</option>
				<option value="canvas">Canvas (not usable in IE)</option>
                </select>
            </div>
            
        </div>
        
        <div>
            <input type="button" onclick="generateBarcode();" value="Generate the barcode" class="btnAction">
        </div>
<div id="barcodeTarget" class="barcodeTarget"></div>
<canvas id="canvasTarget" width="150" height="150"></canvas>
   
</div>
</div>
</body>
</html>
