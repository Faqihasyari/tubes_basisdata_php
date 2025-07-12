<?php
include 'koneksi.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit;
}
$data = mysqli_query($conn, "SELECT p.*, b.judul, u.nama FROM peminjaman p 
  JOIN buku b ON p.id_buku=b.id_buku 
  JOIN user u ON p.id_user=u.id_user");
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
      <h1>Daftar Peminjaman</h1>
      <div class="nav-links">
        <a href="dashboard_admin.php">Dashboard</a>
      </div>
    </div>

    <table class="styled-table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Buku</th>
          <th>Pinjam</th>
          <th>Kembali</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($d = mysqli_fetch_array($data)) { ?>
          <tr class="<?= (date('Y-m-d') > $d['tanggal_kembali'] && $d['status_pinjam'] == 'dipinjam') ? 'row-terlambat' : '' ?>">
            <td><?= $d['nama'] ?></td>
            <td><?= $d['judul'] ?></td>
            <td><?= $d['tanggal_pinjam'] ?></td>
            <td><?= $d['tanggal_kembali'] ?></td>
            <td><?= $d['status_pinjam'] ?></td>
            <td>
              <?php if ($d['status_pinjam'] == 'dipinjam') { ?>
                <a href="kembali.php?id=<?= $d['id_pinjam'] ?>&id_buku=<?= $d['id_buku'] ?>" class="btn-pinjam">Kembalikan</a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
