<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
  $judul = $_POST['judul'];
  $pengarang = $_POST['pengarang'];
  $tahun = $_POST['tahun'];

  mysqli_query($conn, "INSERT INTO buku (judul, pengarang, tahun_terbit) VALUES ('$judul', '$pengarang', '$tahun')");
  header("Location: buku_list.php");
}
