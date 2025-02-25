<?php
// Include database connection
include('../../db_connection.php'); // Replace with your database connection file

if (isset($_GET['id_wali'])) {
  // Get id_wali from URL
  $id_wali = mysqli_real_escape_string($conn, $_GET['id_wali']);

  // SQL query to delete the wali_kelas data
  $sql = "DELETE FROM wali_kelas WHERE id_wali = '$id_wali'";

  // Execute the query
  if (mysqli_query($conn, $sql)) {
    // Redirect back to the main page with success message
    echo "<script>
                alert('Data wali kelas berhasil dihapus!');
                window.location.href='data_wali_kelas.php';
              </script>";
  } else {
    // If there is an error, redirect back with an error message
    echo "<script>
                alert('Error Hapus Data!');
                window.location.href='data_wali_kelas.php';
              </script>";
  }
} else {
  // If id_wali is not provided, redirect to the main page
  header('Location: data_wali_kelas.php');
  exit();
}
