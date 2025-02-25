<?php
include '../../db_connection.php';

if (isset($_GET['id_mapel'])) {
    $id_mapel = $_GET['id_mapel'];

    // Fetch class data
    $stmt = $conn->prepare("SELECT * FROM mapel WHERE id_mapel = ?");
    $stmt->bind_param("s", $id_mapel);
    $stmt->execute();
    $result = $stmt->get_result();
    $mapel = $result->fetch_assoc();

    if (!$mapel) {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID Mapel tidak ditemukan!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_mapel = $_POST['id_mapel']; // CHAR(4)
    $nama_mapel = $_POST['nama_mapel']; // VARCHAR

    // Update class data
    $stmt = $conn->prepare("UPDATE mapel SET nama_mapel=? WHERE id_mapel=?");
    $stmt->bind_param("ss", $nama_mapel, $id_mapel);
    
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='data_mapel.php';</script>";
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
    <title>Edit Mapel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Mapel</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">ID Mapel</label>
                <input type="text" name="id_mapel" class="form-control" value="<?= htmlspecialchars($mapel['id_mapel']); ?>" readonly>

            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mapel</label>
                <input type="text" name="nama_mapel" class="form-control" value="<?= htmlspecialchars($mapel['nama_mapel']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="data_mapel.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
