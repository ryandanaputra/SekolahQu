<?php
include '../../db_connection.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];

    // Hapus data siswa berdasarkan NIS
    $stmt = $conn->prepare("DELETE FROM siswa WHERE nis = ?");
    $stmt->bind_param("s", $nis);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='data_siswa.php';</script>";
    } else {
        echo "Gagal menghapus data!";
    }
} else {
    echo "NIS tidak ditemukan!";
}
?>
