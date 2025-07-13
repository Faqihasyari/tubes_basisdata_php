<?php
include 'koneksi.php';
$id = $_GET['id'];

// Hapus dulu semua peminjaman yang terkait buku ini
mysqli_query($conn, "DELETE FROM peminjaman WHERE id_buku=$id");

// Baru hapus bukunya
mysqli_query($conn, "DELETE FROM buku WHERE id_buku=$id");

header("Location: buku_list.php");
?>
