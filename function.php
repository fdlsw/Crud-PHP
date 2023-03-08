<?php
// koneksi ke Database
$db = mysqli_connect("localhost", "root", "", "fadhilphp");


function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $db;
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $notelp = htmlspecialchars($data["notelp"]);
    $gambar = htmlspecialchars($data["gambar"]);

    // Upload gambar

    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO siswa
              VALUES
    ('', '$nama', '$jurusan', '$notelp', '$gambar')
    ";
mysqli_query($db, $query );

return mysqli_affected_rows($db);
}

function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFIle= $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang di upload

    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar nya!');
              </script>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
            alert('yang anda masukan bukan gambar!');
            </script>";
        return false;
    }
    
    // Cek apakah ukuran gambar sesuai 

    if( $ukuranFIle > 1000000) {
        echo "<script>
        alert('ukuran nya kebesaran!');
      </script>";
        return false;
    }

    move_uploaded_file($tmpName,'img/' . $namaFile);

    return $namaFile    ;


}


function hapus($id){
    global $db;
    mysqli_query($db, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($db);
}

function edit($data) {
    global $db;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $notelp = htmlspecialchars($data["notelp"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);


    // cek apakah gambar benar
    if($_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload(); 
    }

    $query = "UPDATE siswa SET 
                nama = '$nama',
                jurusan = '$jurusan',
                notelp = '$notelp',
                gambar = '$gambar' 
            WHERE id = $id
                ";  

mysqli_query($db, $query);

return mysqli_affected_rows($db);

}


function cari($keyword) {
    $query = "SELECT * FROM siswa
                WHERE
            nama LIKE '%$keyword%' OR
            notelp LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
    return query($query);
}

function registrasi($data) {
    global $db;


    $username = strtolower(stripcslashes($data["username"])) ;
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    // Cek username sudah ada atau belum

    $result = mysqli_query($db, "SELECT username FROM  users WHERE 
            username = '$username' ");
        
        if(mysqli_fetch_assoc($result) ){
            echo "<script>
                    alert('username yang dipilih sudah terdaftar!')
                  </script>";
            return false;
            
            
        }

    // Cek Konfirmasi password

    if( $password !== $password2 ) {
        echo "<script>
                alert('Password tidak sesuai!');
                </script>";
            return false;
    }

    //  enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database

    mysqli_query($db, "INSERT INTO users VALUES('', '$username', '$password')");
    
    return mysqli_affected_rows($db);   



}


?>
