<?php 
// session
session_start();

if ( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
    
}

// menghubunhkan
require "functions.php";

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// cek tombol submit sudah di pencet apa belum
if( isset($_POST["submit"]) ) {
    // var_dump($_POST);   
    // var_dump($_FILES);
    // die;

    // cek daa berhasil ditambahkan atau tidak
    if( tambah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhsil ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
                alert('data gagal ditambahkan');
                document.location.href = '';
            </script>
        ";
    }
}

?>

<html lang="en">
<head>
    <title>Form Tambah Data</title>
    <link rel="stylesheet" href="CSS/css.css">
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="POST" enctype="multipart/form-data">
    <table border="0" cellpadding="5" cellspacing="0">
        <tr>
            <th colspan="3">Menu</th>
        </tr>
            <tr>
                <td><label for="nrp">NRP</label></td><td>:</td>
                <td><input type="text" name="nrp" id="nrp" size="30" required></td>
            </tr>
            <tr>
                <td><label for="nama">Nama</label></td><td>:</td>
                <td><input type="text" name="nama" id="nama" size="30" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td><td>:</td>
                <td><input type="text" name="email" id="email" size="30" required> </td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan</label></td><td>:</td>
                <td><input type="text" name="jurusan" id="jurusan" size="30" required></td>
            </tr>
            <tr>
            <td><label for="gambar" >Gambar</label></td><td>:</td>
            <td><input type="file" name="gambar" id="gambar" ></td>
            </tr>
            <tr>
                <td></td><td></td><td><button type="submit" name="submit">Tambah</button></td>
            </tr>
            <tr>
                <td></td><td></td><td><a href="index.php">Kembali</a></td>
            </tr>
        </table>


</body>
</html>