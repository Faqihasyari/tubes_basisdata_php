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
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard-wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="profile-section">
      <img src="assets/crud.jpg" alt="Admin Image" />
      <p><?= $_SESSION['user']; ?></p>
      <small>ADMIN</small>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-dashboard">
    <div class="top-nav">
      <h1>Dashboard Admin</h1>
      <div class="nav-links">
        <a href="buku_form.php">Tambah Buku</a>
        <a href="buku_list.php">Kelola Buku</a>
        <a href="peminjaman_list.php">Daftar Peminjaman</a>
      </div>
    </div>

    <!-- Card Stats -->
    <div class="card-grid">
      <div class="info-card">
        <h3>Total Buku</h3>
        <p>
          <?php 
            include 'koneksi.php';
            $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM buku"));
            echo $count['total'] . " buku";
          ?>
        </p>
      </div>
      <div class="info-card">
        <h3>Buku Dipinjam</h3>
        <p>
          <?php 
            $pinjam = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM peminjaman WHERE status_pinjam='dipinjam'"));
            echo $pinjam['total'] . " buku";
          ?>
        </p>
      </div>
      <div class="info-card">
        <h3>User Aktif</h3>
        <p>
          <?php 
            $users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM user"));
            echo $users['total'] . " user";
          ?>
        </p>
      </div>
    </div>

    <!-- Welcome Section -->
    <div class="welcome-box">
      <h2>Selamat datang, <?= $_SESSION['user']; ?>!</h2>
      <p>Gunakan menu di atas untuk mengelola data buku, melihat peminjaman, dan mengatur sistem perpustakaan.</p>
    </div>
  </div>
</div>
</body>
</html>
