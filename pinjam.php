<?php
include 'koneksi.php';
session_start();

// Pastikan user login dan memiliki role 'user'
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'user') {
    header("Location: index.html");
    exit;
}

// Ambil nama dari session (bukan email)
$nama = $_SESSION['user'];

// Ambil id_user berdasarkan nama
$getUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_user FROM user WHERE nama='$nama'"));

if (!$getUser) {
    echo "User tidak ditemukan. Pastikan login sebagai user.";
    exit;
}

$id_user = $getUser['id_user'];

// Ambil daftar buku yang tersedia
$data = mysqli_query($conn, "SELECT * FROM buku WHERE status='tersedia'");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pinjam Buku</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h3>Daftar Buku yang Tersedia</h3>
  <table border="1">
    <tr>
      <th>Judul</th>
      <th>Pengarang</th>
      <th>Tahun Terbit</th>
      <th>Aksi</th>
    </tr>
    <?php while ($d = mysqli_fetch_array($data)) { ?>
      <tr>
        <td><?= $d['judul'] ?></td>
        <td><?= $d['pengarang'] ?></td>
        <td><?= $d['tahun_terbit'] ?></td>
        <td><a href="proses_pinjam.php?id_buku=<?= $d['id_buku'] ?>&id_user=<?= $id_user ?>">Pinjam</a></td>
      </tr>
    <?php } ?>
  </table>
  <br>
  <a href="dashboard_user.php">Kembali ke Dashboard</a>
</body>
</html>
