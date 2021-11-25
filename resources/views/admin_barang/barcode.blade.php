<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Barcode Generator: Serambi Laravel</title>
  </head>
  <body>
  <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="#">
        <img src="https://serambilaravel.com/wp-content/uploads/2021/01/Serambi-Laravel-Icon.png" alt="" width="30" height="30" class="d-inline-block align-top">
        <b>Serambi</b> Laravel - Catatan Koding Seputar Framework Laravel
        </a>
    </div>
    </nav>
    <br>
    <br>
    <br>
    <div class="container-fluid px-5">
        <b><h2>Scan Barcode Disini:</h2></b>
    <br>

        <h3>Product: 0001245259636</h3>
            @php
                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
            @endphp
            
            {!! $generator->getBarcode('0001245259636', $generator::TYPE_CODE_128) !!}
            
            
            <h3>Product 2: 000005263635</h3>
            @php
                $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
            @endphp
            
            <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('000005263635', $generatorPNG::TYPE_CODE_128)) }}">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>