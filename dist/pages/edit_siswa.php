<?php
include '../../db_connection.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];

    // Mengambil data siswa berdasarkan NIS
    $stmt = $conn->prepare("SELECT * FROM siswa WHERE nis = ?");
    $stmt->bind_param("s", $nis);
    $stmt->execute();
    $result = $stmt->get_result();
    $siswa = $result->fetch_assoc();

    if (!$siswa) {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "NIS tidak ditemukan!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    // Update data siswa
    $stmt = $conn->prepare("UPDATE siswa SET nama=?, kelas=?, alamat=?, no_telepon=? WHERE nis=?");
    $stmt->bind_param("sssss", $nama, $kelas, $alamat, $no_telepon, $nis);
    
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='data_siswa.php';</script>";
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
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Siswa</h2>
        <form method="post">
        <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($siswa['nis']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($siswa['nama']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($siswa['kelas']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?= htmlspecialchars($siswa['alamat']); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input type="text" name="no_telepon" class="form-control" value="<?= htmlspecialchars($siswa['no_telepon']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="data_siswa.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
