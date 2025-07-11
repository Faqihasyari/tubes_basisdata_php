<?php
include 'koneksi.php'; session_start();
$data = mysqli_query($conn, "SELECT p.*, b.judul, u.nama FROM peminjaman p JOIN buku b ON p.id_buku=b.id_buku JOIN user u ON p.id_user=u.id_user");
?>
<h3>Daftar Peminjaman</h3>
<a href="dashboard_admin.php">Dashboard</a>
<table border="1">
<tr><th>Nama</th><th>Buku</th><th>Pinjam</th><th>Kembali</th><th>Status</th><th>Aksi</th></tr>
<?php while ($d = mysqli_fetch_array($data)) { ?>
<tr>
  <td><?= $d['nama'] ?></td>
  <td><?= $d['judul'] ?></td>
  <td><?= $d['tanggal_pinjam'] ?></td>
  <td><?= $d['tanggal_kembali'] ?></td>
  <td><?= $d['status_pinjam'] ?></td>
  <td>
    <?php if ($d['status_pinjam'] == 'dipinjam') { ?>
      <a href="kembali.php?id=<?= $d['id_pinjam'] ?>&id_buku=<?= $d['id_buku'] ?>">Kembalikan</a>
    <?php } ?>
  </td>
</tr>
<?php } ?>
</table>