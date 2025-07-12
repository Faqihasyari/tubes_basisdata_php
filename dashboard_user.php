<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: index.html");
    exit;
}

include 'koneksi.php';

$nama_user = $_SESSION['user'];

// Ambil ID user berdasarkan nama
$get_id_user_query = mysqli_query($conn, "SELECT id_user FROM user WHERE nama='$nama_user'");
$data_user = mysqli_fetch_assoc($get_id_user_query);
$id_user = $data_user['id_user'];

// Query dinamis
$query_dipinjam = mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman WHERE id_user='$id_user' AND status_pinjam='dipinjam'");
$data_dipinjam = mysqli_fetch_assoc($query_dipinjam);
$total_dipinjam = $data_dipinjam['total'];

$query_tersedia = mysqli_query($conn, "SELECT COUNT(*) AS total FROM buku WHERE status='tersedia'");
$data_tersedia = mysqli_fetch_assoc($query_tersedia);
$total_tersedia = $data_tersedia['total'];

$query_riwayat = mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman WHERE id_user='$id_user'");
$data_riwayat = mysqli_fetch_assoc($query_riwayat);
$total_riwayat = $data_riwayat['total'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="profile-section">
                <img src="assets/crud.jpg" alt="User Avatar">
                <p><?= $_SESSION['user']; ?></p>
                <small>USER</small>
            </div>
            <a href="logout.php" class="logout-btn">Logout</a>
        </aside>

        <!-- Main Area -->
        <main class="main-dashboard">
            <!-- Top Navigation -->
            <div class="top-nav">
                <h1>Dashboard</h1>
                <div class="nav-links">
                    <a href="pinjam.php">Pinjam Buku</a>
                    <a href="riwayat_user.php">Riwayat Pinjam</a>
                    <a href="#">Profil</a>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="content-wrapper">
                <div class="card-grid">
                    <div class="info-card">
                        <h3>Buku Dipinjam</h3>
                        <p><strong><?= $total_dipinjam ?> buku</strong></p>
                    </div>
                    <div class="info-card">
                        <h3>Buku Tersedia</h3>
                        <p><strong><?= $total_tersedia ?> buku</strong></p>
                    </div>
                    <div class="info-card">
                        <h3>Riwayat Pinjam</h3>
                        <p><strong><?= $total_riwayat ?> total</strong></p>
                    </div>
                </div>

                <!-- Welcome Section -->
                <div class="welcome-box">
                    <h2>Selamat datang, <?= $_SESSION['user']; ?>!</h2>
                    <p>Gunakan menu di atas untuk meminjam buku, melihat riwayat, atau memperbarui profil Anda.</p>
                </div>
            </div>

        </main>
        <div class="recent-books">
            <h3>Buku Terakhir Dipinjam</h3>
            <ul>
                <?php
                $query_recent = mysqli_query($conn, "SELECT buku.judul FROM peminjaman 
      JOIN buku ON peminjaman.id_buku = buku.id_buku 
      WHERE peminjaman.id_user = '$id_user' 
      ORDER BY peminjaman.tanggal_pinjam DESC 
      LIMIT 5");

                if (mysqli_num_rows($query_recent) > 0) {
                    while ($row = mysqli_fetch_assoc($query_recent)) {
                        echo "<li>" . htmlspecialchars($row['judul']) . "</li>";
                    }
                } else {
                    echo "<li>Tidak ada buku dipinjam.</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>

</html>