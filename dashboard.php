<?php
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>AdminLTE v4</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
  <script>window.location.href = 'dist/pages/index.php'</script>
</body>
</html>