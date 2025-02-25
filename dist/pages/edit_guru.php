<?php
include '../../db_connection.php';

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    // Fetch guru data with mapel join
    $stmt = $conn->prepare("SELECT guru.*, mapel.nama_mapel FROM guru INNER JOIN mapel ON guru.id_mapel = mapel.id_mapel WHERE guru.nip = ?");
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    $result = $stmt->get_result();
    $guru = $result->fetch_assoc();

    if (!$guru) {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "Data Guru tidak ditemukan!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['nip']; // CHAR(4)
    $nama_guru = $_POST['nama_guru']; // VARCHAR
    $alamat = $_POST['alamat']; // VARCHAR
    $no_hp = $_POST['no_hp']; // VARCHAR
    $jenis_kelamin = $_POST['jenis_kelamin']; // ENUM
    $id_mapel = $_POST['id_mapel']; // INT

    // Update guru data
    $stmt = $conn->prepare("UPDATE guru SET nama_guru=?, alamat=?, no_hp=?, jenis_kelamin=?, id_mapel=? WHERE nip=?");
    $stmt->bind_param("sssssi", $nama_guru, $alamat, $no_hp, $jenis_kelamin, $id_mapel, $nip);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='data_guru.php';</script>";
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
    <title>Edit Data Guru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Data Guru</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($guru['nip']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_guru">Nama Guru</label>
                <input type="text" name="nama_guru" class="form-control" value="<?= htmlspecialchars($guru['nama_guru']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($guru['alamat']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" value="<?= htmlspecialchars($guru['no_hp']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php echo ($guru['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo ($guru['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mapel</label>
                <select class="form-control" id="nama_mapel" name="id_mapel" required>
                    <?php
                    $query_mapel = "SELECT * FROM mapel";
                    $result_mapel = mysqli_query($conn, $query_mapel);
                    while ($mapel = mysqli_fetch_assoc($result_mapel)) {
                        $selected = ($guru['id_mapel'] == $mapel['id_mapel']) ? 'selected' : '';
                        echo "<option value='" . $mapel['id_mapel'] . "' $selected>" . $mapel['nama_mapel'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="data_guru.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>