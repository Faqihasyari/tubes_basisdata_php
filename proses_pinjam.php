<?php
include 'koneksi.php';
session_start();

if (!isset($_GET['id_buku']) || !isset($_GET['id_user'])) {
    echo "Data tidak lengkap.";
    exit;
}

$id_buku = $_GET['id_buku'];
$id_user = $_GET['id_user'];
$tanggal_pinjam = date('Y-m-d');

// Insert data peminjaman
$query = mysqli_query($conn, "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, status_pinjam)
                              VALUES ('$id_user', '$id_buku', '$tanggal_pinjam', 'dipinjam')");

// Update status buku menjadi dipinjam
$update = mysqli_query($conn, "UPDATE buku SET status='dipinjam' WHERE id_buku='$id_buku'");

if ($query && $update) {
    header("Location: riwayat_user.php");
} else {
    echo "Gagal memproses peminjaman.";
}
