<?php
include 'koneksi.php';
$id_buku = $_GET['id_buku'];
$id_user = $_GET['id_user'];
$tanggal = date('Y-m-d');

// Cek jumlah buku yang sedang dipinjam user
$cekPinjam = mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman WHERE id_user=$id_user AND status_pinjam='dipinjam'");
$total = mysqli_fetch_assoc($cekPinjam)['total'];

if ($total >= 3) {
    echo "<script>alert('Maksimal 3 buku boleh dipinjam!'); window.location='pinjam.php';</script>";
    exit;
}

// Lanjut proses pinjam
mysqli_query($conn, "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam) VALUES ($id_user, $id_buku, '$tanggal_pinjam')");
mysqli_query($conn, "UPDATE buku SET status='dipinjam' WHERE id_buku=$id_buku");
header("Location: pinjam.php");