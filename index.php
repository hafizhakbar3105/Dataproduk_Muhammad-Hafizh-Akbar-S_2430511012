<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk - Web Hafizh</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div style="text-align: center; margin-bottom: 20px;">
        <img src="img/logongs.jpeg" alt="Logo NGS" style="width: 150px; height: auto;">
    </div>
        <h2>Daftar Stock Barang Toko NGS</h2>
        <a href="admin.php" class="btn-tambah">Tambah Produk Baru</a>
        
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM produk");
                while($row = mysqli_fetch_assoc($query)):
                ?>
                <tr>
                    <td><img src="img/<?= $row['foto']; ?>" width="50"></td>
                    <td><?= $row['nama_produk']; ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?= $row['stok']; ?></td>
                    <td>
                        <a href="admin.php?edit=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                        <a href="admin.php?hapus=<?= $row['id']; ?>" class="btn-hapus" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>