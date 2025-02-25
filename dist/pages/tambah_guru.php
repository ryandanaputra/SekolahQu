<?php
include '../../db_connection.php'; // File koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    
    $nip = $_POST['nip'];
    $namaguru = $_POST['nama_guru'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['no_hp'];
    $jk = $_POST['jenis_kelamin'];
    $id_mapel = $_POST['id_mapel'];

    // Query untuk menambahkan data ke database
    $query = "INSERT INTO guru (nip, nama_guru, alamat, no_hp, jenis_kelamin, id_mapel) VALUES ('$nip', '$namaguru', '$alamat', '$nohp', '$jk', '$id_mapel')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data guru berhasil ditambahkan!');
                window.location.href='data_guru.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data guru : " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }

    mysqli_close($conn);
}
?>
