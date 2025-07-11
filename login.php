<?php
include 'koneksi.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Cek admin
$queryAdmin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
if (mysqli_num_rows($queryAdmin) > 0) {
    $_SESSION['role'] = 'admin';
    $_SESSION['user'] = $username;
    header("Location: dashboard_admin.php");
    exit;
}

// Cek user
$queryUser = mysqli_query($conn, "SELECT * FROM user WHERE email='$username' AND password='$password'");
if (mysqli_num_rows($queryUser) > 0) {
    $dataUser = mysqli_fetch_assoc($queryUser); // Ambil datanya
    $_SESSION['role'] = 'user';
    $_SESSION['user'] = $dataUser['nama'];
    header("Location: dashboard_user.php");
    exit;
}

// Login gagal
echo "<script>alert('Login gagal!'); window.location='index.html';</script>";
?>
