<?php
session_start();
if ($_SESSION['role'] != 'admin') { 
  header("Location: index.html"); 
  exit; 
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Buku</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard-wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="profile-section">
      <img src="assets/user.png" alt="Admin Image" />
      <p><?= $_SESSION['user']; ?></p>
      <small>ADMIN</small>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-dashboard">
    <div class="top-nav">
      <h1>Tambah Buku</h1>
      <div class="nav-links">
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="buku_list.php">Kelola Buku</a>
        <a href="peminjaman_list.php">Daftar Peminjaman</a>
      </div>
    </div>

    <div class="welcome-box">
      <h2>Form Tambah Buku</h2>
      <form action="buku_proses.php" method="POST">
        <label>Judul Buku</label>
        <input type="text" name="judul" required>

        <label>Pengarang</label>
        <input type="text" name="pengarang">

        <label>Tahun Terbit</label>
        <input type="number" name="tahun">

        <button type="submit" name="simpan" class="btn-pinjam">Simpan</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
