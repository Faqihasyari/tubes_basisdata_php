<?php
include 'koneksi.php';

$nama     = $_POST['nama'];
$email    = $_POST['email'];
$password = $_POST['password'];
$role     = $_POST['role'];
$kode_admin = isset($_POST['kode_admin']) ? $_POST['kode_admin'] : null;

if (empty($nama) || empty($email) || empty($password) || empty($role)) {
    echo "<script>alert('Semua field wajib diisi!'); window.location='register.html';</script>";
    exit;
}

if ($role === 'admin') {
    $kode_rahasia = "ADMIN123";

    if ($kode_admin !== $kode_rahasia) {
        echo "<script>alert('Kode rahasia admin salah!'); window.location='register.html';</script>";
        exit;
    }

    // Simpan ke admin
    $query = "INSERT INTO admin (username, password) VALUES ('$nama', '$password')";
} else {
    // Simpan ke user
    $query = "INSERT INTO user (nama, email, password) VALUES ('$nama', '$email', '$password')";
}

$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>alert('Registrasi berhasil!'); window.location='index.html';</script>";
} else {
    echo "<script>alert('Registrasi gagal!'); window.location='register.html';</script>";
}
?>
