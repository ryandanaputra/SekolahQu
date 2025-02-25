<?php
include '../../db_connection.php';

if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];

    // Hapus data siswa berdasarkan NIS
    $stmt = $conn->prepare("DELETE FROM kelas WHERE id_kelas = ?");
    $stmt->bind_param("s", $id_kelas);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='data_kelas.php';</script>";
    } else {
        echo "Gagal menghapus data!";
    }
} else {
    echo "Id Kelas tidak ditemukan!";
}
?>
