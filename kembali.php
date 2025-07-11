<?php
include 'koneksi.php';
$id_pinjam = $_GET['id'];
$id_buku = $_GET['id_buku'];
$tanggal_kembali = date('Y-m-d');

mysqli_query($conn, "UPDATE peminjaman SET status_pinjam='kembali', tanggal_kembali='$tanggal_kembali' WHERE id_pinjam=$id_pinjam");
mysqli_query($conn, "UPDATE buku SET status='tersedia' WHERE id_buku=$id_buku");

header("Location: peminjaman_list.php");
