<?php 
// Koneksi ke databases
$conn = mysqli_connect("localhost", "root", "", "phpdasar");
 
// READ
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result ) ) {
        $rows[] = $row;
    }
    return $rows;
} 


// TAMBAH
function tambah($data) {
    global $conn;
    // ambil data daru setiap form
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    
    $gambar = upload();
        if( !$gambar ){
            return false;
        }
        
     // query insert data
     $query = "INSERT INTO siswa
     VALUES
     ('','$nrp','$nama','$email','$jurusan','$gambar')
     ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){

    $namafile = $_FILES['gambar']['name'];
    $tempatfile = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];
    $ukuranfile = $_FILES['gambar']['size'];
    
    // cek apakah tidak ada gambar yang di upload 
    if ( $error === 4) {
        echo "<script>
        alert('Pilih Gambar Terlebih Dahulu');
        </script>
        ";
}

    // cek yang di uplaod adalah gambar 
    $extensigambarvalid = ['jpg','png','jpeg'];
    $extensigambar = explode('.', $namafile);
    $extensigambar = strtolower(end($extensigambar));
    if( !in_array($extensigambar, $extensigambarvalid) ) {
        echo "<script>
        alert('Yang Anda Upload Bukan Gambar!');
        </script>
        ";
    }

    // cek jika ukuran terlalu besar 
    if ($ukuranfile > 1000000) {
        echo "<script>
        alert('Ukuran File Terlalu Besar');
        </script>
        ";
        return false;
    }
    
    // loloslkan gambar yang seseuai
    // generate nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $extensigambar;
    move_uploaded_file($tempatfile, 'gambar/' . $namafilebaru);

    return $namafilebaru;
    
}

// DELETE
    function hapus($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    // UPDATE / UBAH
    function ubah($data) {
    global $conn;
    // ambil data daru setiap form

    $id = ($data["id"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);
    
    // cek apaka user pilih gambar baru apa tidak 
    if( $_FILES['gambar']['error'] === 4 ) { 
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

     // query insert data
     $query = "UPDATE siswa SET 
                nrp = '$nrp',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id;
     ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

    }
    
    function cari($keyword) {
        global $conn;
        $query = "SELECT * FROM siswa
         WHERE 
          nama LIKE '%$keyword%' OR
          nrp LIKE '%$keyword%' OR
          email LIKE '%$keyword%'OR
          jurusan LIKE '%$keyword%'
         ";

        return query($query);
    }

    function registrasi($data) {
        global $conn;

        $ussername = strtolower(stripslashes($data["ussername"]));
        $nama = htmlspecialchars($data["nama"]);
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    

        // cek ussername sudah ada atau belum 
        $result = mysqli_query($conn, "SELECT ussername FROM usser WHERE 
                        ussername = '$ussername'");
        if ( mysqli_fetch_assoc($result) ) {
            echo "<script>
            alert('ussername sudah dipakai')
            </script>";
            return false;
        } 
        
        // konfirmasi password
        if( $password !== $password2 ) {
            echo "<script>
            alert('password tidak sesuai');
            </script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan usser baru ke database
        mysqli_query($conn, "INSERT INTO usser VALUES ('','$ussername','$password','$nama')");
       
        return mysqli_affected_rows($conn);
        
    }




?>