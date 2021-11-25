<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngoding Malem</title>
</head>

<body>

    <div class="container">

        <form method="post">
            <h3>Data 1</h3>
            <label>Nama Produk</label><input type="text" name="name[]" /><br />
            <label>Jumlah</label><input type="text" name="jumlah[]" /><br />
            <h3>Data 2</h3>
            <label>Nama Produk</label><input type="text" name="name[]" /><br />
            <label>Jumlah</label><input type="text" name="jumlah[]" /><br />
            <h3>Data 3</h3>
            <label>Nama Produk</label><input type="text" name="name[]" /><br />
            <label>Jumlah</label><input type="text" name="jumlah[]" /><br />
            <input type="submit" value="save" name="submit" />
        </form>

    </div>


    <?php
    if (isset($_POST['submit'])) {
        //Tulis codenya disini supaya bisa tarik seluruh data di atas
        foreach ($_POST['name'] as $index => $value) {
            echo 'Beli ' . $_POST['name'][$index] . ' sebanyak ' . $_POST['jumlah'][$index] . '<br>' ; 
        }
    }
    ?>

</body>

</html> 