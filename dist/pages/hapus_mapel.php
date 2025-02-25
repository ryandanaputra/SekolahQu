<?php
include '../../db_connection.php';

if (isset($_GET['id_mapel'])) {
    $id_mapel = $_GET['id_mapel'];

    // Hapus data siswa berdasarkan NIS
    $stmt = $conn->prepare("DELETE FROM mapel WHERE id_mapel = ?");
    $stmt->bind_param("s", $id_mapel);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='data_mapel.php';</script>";
    } else {
        echo "Gagal menghapus data!";
    }
} else {
    echo "Id mapel tidak ditemukan!";
}
?>
