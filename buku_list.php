<?php
include 'koneksi.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit;
}
$data = mysqli_query($conn, "SELECT * FROM buku");
?>
<head>
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<div class="dashboard-wrapper">
  <div class="sidebar">
    <div class="profile-section">
      <img src="assets/crud.jpg" alt="Admin">
      <p><?= $_SESSION['user']; ?></p>
      <span>ADMIN</span>
    </div>
    <a class="logout-btn" href="logout.php">Logout</a>
  </div>

  <div class="main-dashboard">
    <div class="top-nav">
      <h1>Daftar Buku</h1>
      <div class="nav-links">
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="buku_form.php" class="btn-pinjam-2" style="color: #4a00e0;">+ Tambah Buku</a>
      </div>
    </div>

    <table class="styled-table">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Pengarang</th>
          <th>Tahun</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($d = mysqli_fetch_array($data)) { ?>
          <tr>
            <td><?= $d['judul'] ?></td>
            <td><?= $d['pengarang'] ?></td>
            <td><?= $d['tahun_terbit'] ?></td>
            <td><?= $d['status'] ?></td>
            <td>
              <a href="hapus_buku.php?id=<?= $d['id_buku'] ?>" class="btn-pinjam">Hapus</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
