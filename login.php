<?php 
session_start();
require 'functions.php';


// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT ussername FROM usser WHERE id = $id ");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan ussername 
    if( $key === hash('sha256', $row['ussername']) ) {
        $_SESSION['login'] =  true;
    }
        
    
}

if ( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

// Pesan Berhasil Registrasi
if ( isset($_GET['pesan']) ) {
   echo  "<script>
        alert('User baru berhasil ditambahkan!');
    </script>";
}

if ( isset($_POST["login"]) ) {
    $ussername = $_POST["ussername"];
    $password = $_POST["password"];

    // mengambil dari databases
    $result = mysqli_query($conn, "SELECT * FROM usser WHERE ussername = '$ussername'");
    
    // cek username
    if ( mysqli_num_rows($result) === 1 ){

        // cek password 
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"]) ) {;
            // cek session
            $_SESSION["login"] = true;

            // cek remember me
            if( isset($_POST["remember"]) ) {
                // buat cookie
                setcookie('id', $row['id'], time() +3600);
                setcookie('key', hash('sha256', $row['ussername']), time()+3600 );
            }

            header('Location: index.php');
            exit;
        }
    }
    
    $error = true;

}

?>

<html lang="en">
<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" href="CSS/css.css">
</head>
<body style="background-image: url(CSS/gambar1.png)">

    <center>
<?php if ( isset ($error) ) : ?>
    <p style="color: yellow; font-style: italic;">Ussername / Password Salah</p>
<?php endif; ?>

    <form action="" method="POST">

    <table border="0" cellpadding="5" cellspacing="0" style="padding-top: 50px;">
        <tr>
            <th colspan="3">Login</th>
        </tr>
        <tr>
            <td><label for="ussername">Ussername</label></td><td>:</td>
            <td><input type="text" name="ussername" id="ussername" autocomplete="off"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td><td>:</td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td colspan="3"><label for="remember">Remember Me</label>
            <input type="checkbox" name="remember" id="remember"></td>
        </tr>
        <tr>
            <td></td><td></td><td><button type="submit" name="login">Login</button></td>
        </tr>
        <tr>
            <td></td><td></td><td><a href="registrasi.php">Daftar Disini</a></td>
        </tr>
    </table>

    </form>
    </center>
</body>
</html>