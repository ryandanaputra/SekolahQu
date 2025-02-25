<?php
include '../../db_connection.php'; // File koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil data dari form

  $id_wali = $_POST['id_wali'];
  $nip = $_POST['nip'];
  $id_kelas = $_POST['id_kelas'];

  // Check if nip exists in guru table
  $guru_check_query = "SELECT * FROM guru WHERE nip = '$nip'";
  $guru_check_result = mysqli_query($conn, $guru_check_query);

  // Check if id_kelas exists in kelas table
  $kelas_check_query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
  $kelas_check_result = mysqli_query($conn, $kelas_check_query);

  if (mysqli_num_rows($guru_check_result) > 0 && mysqli_num_rows($kelas_check_result) > 0) {
    // Query untuk menambahkan data ke database
    $query = "INSERT INTO wali_kelas (id_wali, nip, id_kelas) VALUES ('$id_wali', '$nip', '$id_kelas')";

    if (mysqli_query($conn, $query)) {
      echo "<script>
                    alert('Data wali kelas berhasil ditambahkan!');
                    window.location.href='data_wali_kelas.php';
                  </script>";
    } else {
      echo "<script>
                    alert('Gagal menambahkan data wali: " . mysqli_error($conn) . "');
                    window.history.back();
                  </script>";
    }
  } else {
    echo "<script>
                alert('Error: NIP atau ID Kelas tidak ditemukan.');
                window.history.back();
              </script>";
  }

  mysqli_close($conn);
} else {
  // Fetch existing guru and kelas data for the form
  $guru_query = "SELECT * FROM guru";
  $guru_result = mysqli_query($conn, $guru_query);

  $kelas_query = "SELECT * FROM kelas";
  $kelas_result = mysqli_query($conn, $kelas_query);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Wali Kelas</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <h2>Tambah Data Wali Kelas</h2>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">ID Wali</label>
        <input type="text" name="id_wali" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">NIP</label>
        <select name="nip" class="form-control" required>
          <?php while ($guru = mysqli_fetch_assoc($guru_result)) { ?>
            <option value="<?= $guru['nip']; ?>"><?= $guru['nama_guru']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">ID Kelas</label>
        <select name="id_kelas" class="form-control" required>
          <?php while ($kelas = mysqli_fetch_assoc($kelas_result)) { ?>
            <option value="<?= $kelas['id_kelas']; ?>"><?= $kelas['nama_kelas']; ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</body>

</html>