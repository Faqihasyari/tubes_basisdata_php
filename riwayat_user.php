<?php
include 'koneksi.php'; 
session_start();

// Ambil nama dari session
$nama = $_SESSION['user'];

// Ambil id_user berdasarkan nama
$getUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_user FROM user WHERE nama='$nama'"));

if (!$getUser) {
    echo "User tidak ditemukan. Pastikan login sebagai user.";
    exit;
}

$id_user = $getUser['id_user'];

// Ambil riwayat peminjaman dari user tersebut
$data = mysqli_query($conn, "SELECT p.*, b.judul FROM peminjaman p JOIN buku b ON p.id_buku=b.id_buku WHERE p.id_user=$id_user");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Riwayat Peminjaman</title>
  <style>
    .terlambat {
      background-color: #ffdddd;
    }
  </style>
</head>
<body>
<h3>Riwayat Peminjaman Anda</h3>
<a href="dashboard_user.php">Dashboard</a>
<table border="1">
<tr><th>Buku</th><th>Pinjam</th><th>Kembali</th><th>Status</th></tr>

<?php while ($d = mysqli_fetch_array($data)) { 
  // Cek apakah pinjaman sudah lewat 7 hari dan belum dikembalikan
  $tanggal_pinjam = new DateTime($d['tanggal_pinjam']);
  $tanggal_sekarang = new DateTime();
  $interval = $tanggal_pinjam->diff($tanggal_sekarang)->days;
  $jatuhTempo = ($interval > 7 && $d['status_pinjam'] == 'dipinjam');
  ?>
  
<tr class="<?= $jatuhTempo ? 'terlambat' : '' ?>">
  <td><?= $d['judul'] ?></td>
  <td><?= $d['tanggal_pinjam'] ?></td>
  <td><?= $d['tanggal_kembali'] ?? '-' ?></td>
  <td>
    <?= $d['status_pinjam'] ?>
    <?php if ($jatuhTempo): ?>
      <span style="color: red;">(Terlambat!)</span>
    <?php endif; ?>
  </td>
</tr>

<?php } ?>
</table>
</body>
</html>
