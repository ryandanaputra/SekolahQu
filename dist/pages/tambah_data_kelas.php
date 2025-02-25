
<?php
include '../../db_connection.php'; // File koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];

    // Query untuk menambahkan data ke database
    $query = "INSERT INTO kelas (id_kelas, nama_kelas) VALUES ('$id_kelas', '$nama_kelas')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data kelas berhasil ditambahkan!');
                window.location.href='data_kelas.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data kelas: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }

    mysqli_close($conn);
}
?>