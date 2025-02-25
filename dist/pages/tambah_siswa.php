
<?php
include '../../db_connection.php'; // File koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    // Query untuk menambahkan data ke database
    $query = "INSERT INTO siswa (nis, nama, kelas, alamat, no_telepon) VALUES ('$nis', '$nama', '$kelas', '$alamat', '$no_telepon')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data siswa berhasil ditambahkan!');
                window.location.href='data_siswa.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data siswa: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }

    mysqli_close($conn);
}
?>