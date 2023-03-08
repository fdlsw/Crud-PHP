<?php
require 'function.php';
if( isset($_POST["register"]) ){

    if( registrasi($_POST) > 0 ){
        echo "<script>
                alert('User baru saja ditambahkan!');
                </script>";
    } else {
        echo mysqli_error($db);
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/login.css">
    
</head>
<body id="login">
    
    <h1 class="login">Halaman Registrasi</h1>

    <form action="" method="post" class="datadiri">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <br>
            <li>
                <label for="password">Passsword :</label>
                <input type="password" name="password" id="password">
            </li>
            <br>
            <li>
                <label for="password2">Confirm Password :</label>
                <input type="password" name="password2" id="password2">
            </li>
            <br>
            <li>
                <button type="submit" name="register" class="tombollogin">Sign Up!</button>
            </li>
            <a href="login.php" class="help">Login</a>
        </ul>
    </form>
</body>
</html>