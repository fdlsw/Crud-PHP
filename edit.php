<?php

session_start();

if( !isset($_SESSION["login"] )  ) {
    header("Location: login.php");
    exit;
}

require 'function.php';
$id = $_GET["id"];  

$mhs = query("SELECT * FROM siswa WHERE id = $id")[0];


if( isset($_POST["submit"])) {


if( edit($_POST) > 0){
    echo "
          <script>
                alert('data berhasil diganti!');
                document.location.href = 'index.php'; 
          </script>
          ";  
} else {
    echo "
    <script>
    alert('data gagal diganti!');
    document.location.href = 'index.php'; 
    </script>
    ";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body id="login">
    <h1 class="login">Edit Data Siswa</h1>

    <form action="" method="post"enctype="multipart/form-data" class="datadiri">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama" > Nama : </label>
                <input type="text" name="nama"  id="nama"
                required value="<?= $mhs["nama"]; ?>">
            </li>
            <br>
            <li>
                <label for="jurusan" > Jurusan : </label>
                <input type="text" name="jurusan"  id="jurusan"
                required value="<?= $mhs["jurusan"]; ?>">
            </li>
            <br>
            <li>
                <label for="notelp" > No telp : </label>
                <input type="text" name="notelp"  id="notelp"
                required value ="<?= $mhs["notelp"]; ?> ">
            </li>
            <br>
            <li>
                <label for="gambar" > Gambar : </label>
                <br>
                <input type="file" name="gambar"  id="gambar"
                required value ="<?= $mhs["gambar"]; ?> ">
            </li>
            <br>
            <button type="submit" name="submit" class="tombollogin"> Ganti! </button>
        </ul>
    </form>
</body>
</html>