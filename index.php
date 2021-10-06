<?php
// mengaktifan session
session_start();

if ( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
    
}

    echo $_COOKIE['id'];
    
// Menghubungkan dengan database
require 'functions.php';

// Mengambil data dari database
$siswa = query(" SELECT * FROM siswa");

// Mencari data berdasarkan keyword
if ( isset($_POST["cari"]) ) {
     $siswa = cari($_POST["keyword"]);
}

if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
// Fitur Anda Login Sebagai 
$id = $_COOKIE['id'];

$tampil = mysqli_query($conn, "SELECT nama FROM usser WHERE id = $id ");
$row = mysqli_fetch_assoc($tampil);
} $error = true;

?> 

<html lang="en">
<head>
    <title>Tabel Siswa </title>
    <link rel="stylesheet" href="CSS/css.css">
</head>
<body style="padding-left: 20px;"> 
    <h1>Daftar Mahasiswa</h1>

    <form  action="" method="POST">

    <table border="0" cellpadding="5" cellspacing="0">
        <th colspan="5">
            MENU
        </th>
        <tr>
            <td>Masukan Data Baru</td><td>:</td><td>   <a href="tambah.php">Tambah data siswa</a></td>
        </tr>
        <tr>
           <td>Cari</td><td>:</td><td><input type="text" name="keyword" size="30"
             autofocus placeholder="Masukan Pencarian" autocomplete="off"  ></td>
        </tr>
        <tr>
            <td></td><td></td><td><button name="cari"> Cari </button></td>
        </tr>
        <?php if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) : ?>
        <tr>
        <?php foreach ($tampil as $anda) : ?>
            <td colspan="3">
               Anda Login Sebagai <?= $anda['nama']; ?>
            </td>
        <?php endforeach; ?>
        
         </tr>
        <?php endif; ?>
        <tr>
            <td colspan="4"><a href="Logout.php">Logout</a></td>
        </tr>
        
    </table>

    </form>
    
    <table border="0" cellpadding="5" cellspacing="0">

    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>NRP</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>

   <?php $i = 1; ?>
    <?php foreach( $siswa as $row) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td> 
            <a href="ubah.php?id=<?= $row["id"] ?>">Ubah | </a> 
            <a href="hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('Hapus??'); ">  Hapus</a> 
        </td>
        <td><?= $row["nrp"] ?></td>
        <td><img src="gambar/<?= $row["gambar"] ?>" alt="gambar" width="60px" height="60px"></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan"]; ?></td>
 
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>

</body>
</html>