<?php 
require 'function.php';

session_start();

if( !isset($_SESSION["login"] )  ) {
    header("Location: login.php");
    exit;
}

$siswa = query("SELECT * FROM siswa");
if( isset($_POST["cari"]) ) {
    $siswa = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body id="index">

<nav>
    <div>
        <img src="img/download.png" class="navlogo" alt="">
    </div>
    <ul>
        <li><a href="">LOGOUT</a></li>
        <li><a href="">PRINT</a></li>
        <li><a href="">ADD</a></li>
    </ul>
    <form action="" method="post" class="formcari">
        <input type="text" name="keyword" size="30" autofocus 
         placeholder="Masukan nama siswa...." id="keyword" class="keyword">
        <button type="submit" name="cari" id="tombol-cari" class="tombolcari">Find!</button>
    </form> 
    </div>
</nav>
    
    <div id="container">
    <table border="1" cellpadding="10" cellspacing="0"  class="table1">

        <tr>
            <th  class="table-dark">No.</th>
            <th class="table-dark">Aksi</th>
            <th class="table-dark">Gambar</th>
            <th class="table-dark">Nama</th>
            <th class="table-dark">No.Telp</th>
            <th class="table-dark">Jurusan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach( $siswa as $row ) : ?>
        <tr>

            <td class="table-dark"><?= $i; ?></td>
            <td class="table-dark">
                <a href="edit.php?id=<?= $row["id"]; ?>" class="button">Edit</a>
                |
                <a href="hapus.php?id=<?= $row["id"]; ?>" class="button">Delete</a>
            </td>
            <td class="table-dark"><img src="img/<?= $row["gambar"];?>" 
            width="50"></td>
            <td class="table-dark"><?= $row["nama"]; ?></td>
            <td class="table-dark"><?= $row["notelp"]; ?></td>
            <td class="table-dark"><?= $row["jurusan"]; ?></td>
        </tr>
        <?php $i++;?>
        <?php endforeach ?>
        </table>
        
        <div class="about">
            <h1>
                AboutMe
            </h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum omnis veniam accusantium architecto animi doloribus, eius rerum ratione, sunt vel nesciunt pariatur, culpa aut nam veritatis dolorum cumque perferendis officia.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora nisi ratione consectetur, natus dolore laborum impedit consequatur quam doloremque molestias velit, alias aut iusto illum sequi, nihil qui fugit in.</p>
        </div>
        
        
            <br>
        <center class="media"> 
        <a href="instagram.com" class="medsos"><img src="img/instagram.png" alt="" class="logo"></a>
        |
        <a href="youtube.com" class="medsos"><img src="img/youtube.png" alt="" class="logo"></a>
        |
        <a href="facebook.com" class="medsos"><img src="img/facebook.png" alt="" class="logo"></a>
        </center>
        </div>

       
<script src="js/script.js"></script>
</body>
</html>