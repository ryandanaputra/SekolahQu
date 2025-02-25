<?php
session_start();
include 'db_connection.php'; //Koneksi ke database

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// query untuk mencari user berdasarkan username
$query = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah data cocok
if ($result->num_rows === 1){
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit();
} else {
    echo('dasar sigma');
}

$stmt->close();
$conn->close();
?>