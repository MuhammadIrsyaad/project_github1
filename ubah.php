<?php
// session
session_start();
if ( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
    
} 

// menghubungkan
require "functions.php";

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


// menangkap id
$id = $_GET['id'];

// query data siswa berdasarkan id
$siswa = query("SELECT * FROM siswa WHERE id = $id")[0];

// cek tombol submit sudah di pencet apa belum
if( isset($_POST["submit"]) ) {

    // cek daa berhasil ditambahkan atau tidak
    if( ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhsil diubah');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
                alert('data gagal diubah');
                document.location.href = '';
            </script>
        ";
    }
}

?>

<html lang="en">
<head>
    <title>Form Ubah Data</title>
    <link rel="stylesheet" href="CSS/css.css">
</head>
<body>
    <h1>Ubah Data Mahasiswa</h1>

    <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $siswa["id"]; ?>">
    <input type="hidden" name="gambarlama" value="<?= $siswa["gambar"]; ?>">
    
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <th colspan="3">Menu</th>
            </tr>
            <tr>
                <td><label for="nrp">NRP</label></td><td>:</td>
                <td><input type="text" name="nrp" id="nrp" size="30" value="<?= $siswa["nrp"];  ?>"required></td>
            </tr>
            <tr>
                <td><label for="nama">Nama</label></td><td>:</td>
                <td><input type="text" name="nama" id="nama" size="30" value="<?= $siswa["nama"]; ?>" required> </td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td><td>:</td>
                <td><input type="text" name="email" id="email" size="30" value="<?= $siswa["email"]; ?>" ></td>
            </tr>
            <tr>
                <td><label for="jurusan">Jurusan</label></td>
                <td>:</td><td><input type="jurusan" name="jurusan" id="jurusan" size="30" value="<?= $siswa["jurusan"]; ?>" required></td>
            </tr>
            <tr>
                <td><label for="gambar" >Gambar</label></td>
                <td>:</td><td><img src="gambar/<?= $siswa["gambar"]; ?>" width="50px" height="50px" ></td>
            </tr>
            <tr>
                <td><label for="gambar">Pilih Gambar</label></td><td>:<td><input type="file" name="gambar" id="gambar"></td></td>
            </tr>
            <tr>
                <td></td><td></td><td><button type="submit" name="submit">ubah</button></td>
            </tr>
            <tr>
                <td></td><td></td><td><a href="index.php">Kembali</a></td>
            </tr>
        </table>
       
</body>
</html>