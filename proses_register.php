<?php
include 'koneksi.php';

$role = $_POST['role'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Cek apakah email/username sudah terdaftar
if ($role == 'user') {
    $cek = mysqli_query($conn, "SELECT * FROM user WHERE email='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar'); window.location='register.html';</script>";
        exit;
    }

    mysqli_query($conn, "INSERT INTO user (nama, email, password) VALUES ('$nama', '$username', '$password')");
    echo "<script>alert('Berhasil daftar sebagai user'); window.location='index.html';</script>";
} else if ($role == 'admin') {
    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah terdaftar'); window.location='register.html';</script>";
        exit;
    }

    mysqli_query($conn, "INSERT INTO admin (nama, username, password) VALUES ('$nama', '$username', '$password')");
    echo "<script>alert('Berhasil daftar sebagai admin'); window.location='index.html';</script>";
}
?>
