<?php
include '../../db_connection.php';

$id_wali = $_POST['id_wali'];
$nip = $_POST['nip'];
$id_kelas = $_POST['id_kelas'];

// Check if id_kelas exists in kelas table
$kelas_check_query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
$kelas_check_result = mysqli_query($conn, $kelas_check_query);

if (mysqli_num_rows($kelas_check_result) > 0) {
    // Insert into wali_kelas table
    $query = "INSERT INTO wali_kelas (id_wali, nip, id_kelas) VALUES ('$id_wali', '$nip', '$id_kelas')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: data_wali_kelas.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: id_kelas does not exist in kelas table.";
}

mysqli_close($conn);
