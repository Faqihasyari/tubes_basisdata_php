<?php
session_start();
if ($_SESSION['role'] != 'admin') { header("Location: index.html"); exit; }
?>

<h3>Form Tambah Buku</h3>
<form action="buku_proses.php" method="POST">
  Judul: <input type="text" name="judul" required><br>
  Pengarang: <input type="text" name="pengarang"><br>
  Tahun Terbit: <input type="number" name="tahun"><br>
  <button type="submit" name="simpan">Simpan</button>
</form>
<a href="dashboard_admin.php">Kembali</a>