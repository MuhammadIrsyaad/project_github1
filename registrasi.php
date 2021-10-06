<?php 

require 'functions.php';

// mengecek apakh tombol register sudah di tekan
if ( isset($_POST["submit"])){

    if( registrasi($_POST) > 0 ) {
        header("Location: Login.php?pesan=berhasil");
    } else {
        echo mysqli_error($conn);
    }
    
}


?>


<html lang="en">
<head>
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="CSS/css.css">
    
</head>
<body class="bg2">
  
<center>
    <form action="" method="post">

    <table class="table2" border="0" cellpadding="5" cellspacing="0" style="padding-top: 150px;">
        <tr>
            <th colspan="3">Form Registrasi</th>
        </tr>
        <tr>
            <td><label for="ussername">Ussername</label></td><td>:</td>
                <td>
                    <input type="text" name="ussername" id="ussername" size="15" 
                    autocomplete="off">
                </td>
        </tr>
        <tr>
            <td><label for="nama">Nama</label></td><td>:</td>
            <td>
            <input type="text" name="nama" id="nama" size="15" autocomplete="off">
            </td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td><td>:</td>
            <td>
                <input type="password" name="password" id="password" size="15">
            </td>
        </tr>
        <tr>
            <td><label for="password2">konfirmasi Password</label></td><td>:</td>
            <td>
                <input type="password" name="password2" id="password2" size="15">
            </td>
        </tr>
        <tr>
            <td></td><td></td><td><button type="submit" name="submit">Daftar</button></td>
        </tr>
        <tr>
            <td colspan="3"><a href="login.php">Kembali Ke Halaman Login</a></td>
        </tr>
    </table>
    
    </form>
    </center>
</body>
</html>