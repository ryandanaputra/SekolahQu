<?php
include '../../db_connection.php';

if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];

    // Fetch class data
    $stmt = $conn->prepare("SELECT * FROM kelas WHERE id_kelas = ?");
    $stmt->bind_param("s", $id_kelas);
    $stmt->execute();
    $result = $stmt->get_result();
    $kelas = $result->fetch_assoc();

    if (!$kelas) {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID Kelas tidak ditemukan!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kelas = $_POST['id_kelas']; // CHAR(4)
    $nama_kelas = $_POST['nama_kelas']; // VARCHAR

    // Update class data
    $stmt = $conn->prepare("UPDATE kelas SET nama_kelas=? WHERE id_kelas=?");
    $stmt->bind_param("ss", $nama_kelas, $id_kelas);
    
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='data_kelas.php';</script>";
    } else {
        echo "Gagal memperbarui data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Kelas</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">ID Kelas</label>
                <input type="text" name="id_kelas" class="form-control" value="<?= htmlspecialchars($kelas['id_kelas']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" value="<?= htmlspecialchars($kelas['nama_kelas']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="data_kelas.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
