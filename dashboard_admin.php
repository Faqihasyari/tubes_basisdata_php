<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit;
}
?>


<h2>Dashboard Admin</h2>
<p>Halo, <?= $_SESSION['user']; ?>!</p>
<a href="buku_form.php">Tambah Buku</a> |
<a href="buku_list.php">Kelola Buku</a> |
<a href="peminjaman_list.php">Daftar Peminjaman</a> |
<a href="logout.php">Logout</a>
