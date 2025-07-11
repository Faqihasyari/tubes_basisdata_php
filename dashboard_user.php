<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: index.html");
    exit;
}
?>

<h2>Dashboard User</h2>
<p>Selamat datang, <?= $_SESSION['user']; ?>!</p>
<a href="pinjam.php">Pinjam Buku</a> |
<a href="riwayat_user.php">Riwayat Pinjam</a> |
<a href="logout.php">Logout</a>
