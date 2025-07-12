<?php
include 'koneksi.php';
session_start();

if (!isset($_GET['id_pinjam'])) {
    header("Location: riwayat_user.php");
    exit;
}

$id_pinjam = $_GET['id_pinjam'];
$tanggal_kembali = date('Y-m-d');

// Update status dan tanggal kembali
mysqli_query($conn, "UPDATE peminjaman SET status_pinjam='dikembalikan', tanggal_kembali='$tanggal_kembali' WHERE id_pinjam=$id_pinjam");

// Update status buku agar tersedia lagi
$get_buku = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_buku FROM peminjaman WHERE id_pinjam=$id_pinjam"));
$id_buku = $get_buku['id_buku'];
mysqli_query($conn, "UPDATE buku SET status='tersedia' WHERE id_buku=$id_buku");

header("Location: riwayat_user.php");
