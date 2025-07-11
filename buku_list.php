<?php
include 'koneksi.php'; session_start(); if ($_SESSION['role'] != 'admin') { header("Location: index.html"); exit; }
$data = mysqli_query($conn, "SELECT * FROM buku");
?>
<h3>Daftar Buku</h3>
<a href="buku_form.php">Tambah Buku</a> | <a href="dashboard_admin.php">Dashboard</a>
<table border="1">
<tr><th>Judul</th><th>Pengarang</th><th>Tahun</th><th>Status</th><th>Aksi</th></tr>
<?php while ($d = mysqli_fetch_array($data)) { ?>
  <tr>
    <td><?= $d['judul'] ?></td>
    <td><?= $d['pengarang'] ?></td>
    <td><?= $d['tahun_terbit'] ?></td>
    <td><?= $d['status'] ?></td>
    <td><a href="hapus_buku.php?id=<?= $d['id_buku'] ?>">Hapus</a></td>
  </tr>
<?php } ?>
</table>