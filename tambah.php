<?php

session_start();

if( !isset($_SESSION["login"] )  ) {
    header("Location: login.php");
    exit;
}   

require 'function.php';
$db = mysqli_connect("localhost", "root", "", "fadhilphp");

if( isset($_POST["submit"])) {
    


if(tambah($_POST) > 0){
    echo "
          <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php'; 
          </script>
          ";  
} else {
    echo "
    <script>
    alert('data gagal ditambahkan!');
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
    <h1 class="login">Tambah Data Siswa</h1>

    <form action="" method="post" enctype="multipart/form-data" class="datadiri">
        <ul>
            <li>
                <label for="nama" class="text" > Nama  : </label>
                <input type="text" name="nama"  id="nama"
                required>
            </li>
            <hr>
            <li>
                <label for="jurusan" > Jurusan : </label>
                <input type="text" name="jurusan"  id="jurusan"
                required>
            </li>
            <hr>
            <li>
                <label for="notelp" > No telp : </label>
                <input type="text" name="notelp"  id="notelp"
                required>
            </li>
            <hr>
            <li>
                <label for="gambar" > Gambar : </label>
                <input type="file" name="gambar"  id="gambar">
            </li>
            <hr>
            
            <button type="submit" name="submit" class="tombollogin"> Daftar! </button>
        </ul>
    </form>
</body>
</html>