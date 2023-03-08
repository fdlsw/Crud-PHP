<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'function.php';
$siswa = query("SELECT * FROM siswa");
$mpdf = new \Mpdf\Mpdf();

$html ='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
<h1>DAFTAR MAHASISWA</h1>
<table border="1" cellpadding="10" cellspacing="0">

<tr>
    <th>No.</th>
    <th>Gambar</th>
    <th>Nama</th>
    <th>No.Telp</th>
    <th>Jurusan</th>
</tr>';
$i = 1;
foreach( $siswa as $row ) {
   $html .= '<tr>
       <td>'. $i++ .'</td>
       <td><img src="img/'. $row["gambar"] .'" width="50"></td>
       <td>'. $row["nama"] .'</td>
       <td>'. $row["notelp"] .'</td>
       <td>'. $row["jurusan"] .'</td>
   </tr>';
}   

$html .= '</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output();

?>