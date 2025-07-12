<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'user') {
    header("Location: index.html");
    exit;
}

$nama = $_SESSION['user'];

$getUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_user FROM user WHERE nama='$nama'"));
if (!$getUser) {
    echo "User tidak ditemukan.";
    exit;
}
$id_user = $getUser['id_user'];
$data = mysqli_query($conn, "SELECT * FROM buku WHERE status='tersedia'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku</title>
    <link rel="stylesheet" href="style.css">
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
            <a href="dashboard_user.php" class="logout-btn">← Kembali</a>
        </aside>

        <!-- Main Content -->
        <main class="main-dashboard">
            <div class="top-nav">
                <h1>Daftar Buku Tersedia</h1>
                <div class="nav-links">
                    <a href="dashboard_user.php">Dashboard</a>
                    <a href="riwayat_user.php">Riwayat</a>
                    <a href="#">Profil</a>
                </div>
            </div>

            <div class="content-wrapper">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Tahun Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($d = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?= $d['judul'] ?></td>
                            <td><?= $d['pengarang'] ?></td>
                            <td><?= $d['tahun_terbit'] ?></td>
                            <td>
                                <a class="btn-pinjam" href="proses_pinjam.php?id_buku=<?= $d['id_buku'] ?>&id_user=<?= $id_user ?>">Pinjam</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
