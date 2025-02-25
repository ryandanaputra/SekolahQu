<?php
// Include database connection
include('../../db_connection.php'); // Replace with your database connection file

if (isset($_GET['nip'])) {
    // Get NIS from URL
    $nip = mysqli_real_escape_string($conn, $_GET['nip']);

    // SQL query to delete the student data
    $sql = "DELETE FROM guru WHERE nip = '$nip'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the main page with success message
        echo "<script>
                alert('Data guru berhasil dihapus!');
                window.location.href='data_guru.php';
              </script>";
    } else {
        // If there is an error, redirect back with an error message
        echo "<script>
        alert('Error Hapus Data!');
        window.location.href='data_guru.php';
      </script>";
    }
} else {
    // If NIS is not provided, redirect to the main page
    header('Location: index.php');
    exit();
}
?>