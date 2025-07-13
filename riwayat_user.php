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

$data = mysqli_query($conn, "SELECT p.*, b.judul FROM peminjaman p JOIN buku b ON p.id_buku=b.id_buku WHERE p.id_user=$id_user");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman</title>
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
                <h1>Riwayat Peminjaman Anda</h1>
                <div class="nav-links">
                    <a href="pinjam.php">Pinjam Buku</a>
                    <a href="dashboard_user.php">Dashboard</a>
                    <a href="#">Profil</a>
                </div>
            </div>

            <div class="content-wrapper">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($d = mysqli_fetch_array($data)) {
                            $tanggal_pinjam = new DateTime($d['tanggal_pinjam']);
                            $tanggal_sekarang = new DateTime();
                            $interval = $tanggal_pinjam->diff($tanggal_sekarang)->days;
                            $jatuhTempo = ($interval > 7 && $d['status_pinjam'] == 'dipinjam');
                            ?>
                            <tr class="<?= $jatuhTempo ? 'row-terlambat' : '' ?>">
                                <td><?= $d['judul'] ?></td>
                                <td><?= $d['tanggal_pinjam'] ?></td>
                                <td><?= $d['tanggal_kembali'] ?? '-' ?></td>
                                <td>
                                    <?= $d['status_pinjam'] ?>
                                    <?php if ($jatuhTempo): ?>
                                        <span style="color: red;">(Terlambat!)</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($d['status_pinjam'] == 'dipinjam'): ?>
                                        <a href="proses_kembali.php?id_pinjam=<?= $d['id_pinjam'] ?>" class="btn-pinjam">Kembalikan</a>
                                    <?php else: ?>
                                        <span style="color: gray;">Selesai</span>
                                    <?php endif; ?>
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
