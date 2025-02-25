<?php
include '../../db_connection.php';

if (isset($_GET['id_wali'])) {
    $id_wali = $_GET['id_wali'];

    // Fetch wali_kelas data with guru and kelas join
    $stmt = $conn->prepare("SELECT wali_kelas.*, guru.nama_guru, kelas.nama_kelas FROM wali_kelas INNER JOIN guru ON wali_kelas.nip = guru.nip INNER JOIN kelas ON wali_kelas.id_kelas = kelas.id_kelas WHERE wali_kelas.id_wali = ?");
    $stmt->bind_param("s", $id_wali);
    $stmt->execute();
    $result = $stmt->get_result();
    $wali_kelas = $result->fetch_assoc();

    if (!$wali_kelas) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='data_wali_kelas.php';</script>";
        exit;
    }

    // Fetch existing guru and kelas data for the form
    $guru_query = "SELECT * FROM guru";
    $guru_result = mysqli_query($conn, $guru_query);

    $kelas_query = "SELECT * FROM kelas";
    $kelas_result = mysqli_query($conn, $kelas_query);
} else {
    echo "<script>alert('Data Wali Kelas tidak ditemukan!'); window.location='data_wali_kelas.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_wali = $_POST['id_wali'];
    $nip = $_POST['nip'];
    $id_kelas = $_POST['id_kelas'];

    // Update wali_kelas data
    $stmt = $conn->prepare("UPDATE wali_kelas SET nip=?, id_kelas=? WHERE id_wali=?");
    $stmt->bind_param("sss", $nip, $id_kelas, $id_wali);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='data_wali_kelas.php';</script>";
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
    <title>Edit Data Wali Kelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Data Wali Kelas</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">ID Wali</label>
                <input type="text" name="id_wali" class="form-control" value="<?= htmlspecialchars($wali_kelas['id_wali']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">NIP</label>
                <select name="nip" class="form-control" required>
                    <?php while ($guru = mysqli_fetch_assoc($guru_result)) { ?>
                        <option value="<?= $guru['nip']; ?>" <?= ($guru['nip'] == $wali_kelas['nip']) ? 'selected' : ''; ?>><?= $guru['nama_guru']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">ID Kelas</label>
                <select name="id_kelas" class="form-control" required>
                    <?php while ($kelas = mysqli_fetch_assoc($kelas_result)) { ?>
                        <option value="<?= $kelas['id_kelas']; ?>" <?= ($kelas['id_kelas'] == $wali_kelas['id_kelas']) ? 'selected' : ''; ?>><?= $kelas['nama_kelas']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="data_wali_kelas.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>