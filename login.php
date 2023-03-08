<?php

session_start();
require 'function.php';

// cek cookie
if( isset($_COOKIE['login']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id

    $result = mysqli_query($db, " SELECT username FROM users WHERE
        id = $id");
    $row = mysqli_fetch_assoc($result); 

    // cek cookie dan username

    if( $key === hash('sha256', $row['username'] ) ){
        $_SESSION['login'] = true; 
    }
}


    if( isset($_POST["login"])){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($db, "SELECT * FROM users WHERE username =
        '$username'");

        // cek username

        if( mysqli_num_rows($result) === 1 ) {

        // cek password

        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])  )  { 
            
            // set session

            $_SESSION["login"] = true;
            
            // cek remember me

            if( isset($_POST['remember']))
            
            // buat cookie

            setcookie('id', $row['id'], time()+3600);
            setcookie('key', hash('sha256', $row['username'] ),
                      time()+3600); 

            header("Location:index.php");
            exit;
        }
        }

        $error = true;

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=x, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head> 
<body id="login">
    
    <h1 class="login">Halaman Login</h1>

    <?php if( isset($error)) : ?>
            <p style="color: red; font-style:italic;"> Username / Password Salah</p>
    <?php endif; ?>

    <form action="" method="post" class="datadiri">
    <ul>
        <li>
            <label for="username" class="help">Username :</label>
            <input type="text" name="username" id="username">
        </li>
        <br>
        <li>
            <label for="password" class="help">Passsword :</label>
            <input type="password" name="password" id="password">
        </li>
        <br>
        <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
        </li>
        <br>
        <li>
            <button type="submit" name="login" target="_blank" class="tombollogin">Login</button>
        </li>
        <br>
        <a href="registrasi.php" class="help">Register dulu mas</a>
        <br>
        <br>    
        <a href="bantuan.php" class="help">Bantuan?</a>
    </ul>
    </form>
    <div>
        <img src="img/ngakak.png" alt="" class="emoji">
    </div>

</body>
</html>