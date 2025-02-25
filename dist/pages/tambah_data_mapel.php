
<?php
include '../../db_connection.php'; // File koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_mapel = $_POST['id_mapel'];
    $nama_mapel = $_POST['nama_mapel'];

    // Query untuk menambahkan data ke database
    $query = "INSERT INTO mapel (id_mapel, nama_mapel) VALUES ('$id_mapel', '$nama_mapel')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data Mapel berhasil ditambahkan!');
                window.location.href='data_mapel.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data Mapel: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }

    mysqli_close($conn);
}
?>