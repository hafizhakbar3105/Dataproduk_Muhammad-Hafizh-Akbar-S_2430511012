<?php 
include 'koneksi.php';

// --- LOGIKA HAPUS ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT foto FROM produk WHERE id='$id'"));
    if($data['foto'] != "") unlink("img/" . $data['foto']);
    mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
    header("Location: index.php");
}

// --- LOGIKA SIMPAN & UPDATE ---
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $foto = $_FILES['foto']['name'];

    if ($foto != "") {
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $nama_foto_baru = time() . "." . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $nama_foto_baru);
        
        if ($id == "") {
            mysqli_query($conn, "INSERT INTO produk VALUES (NULL, '$nama', '$harga', '$stok', '$nama_foto_baru')");
        } else {
            mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok', foto='$nama_foto_baru' WHERE id='$id'");
        }
    } else {
        mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id='$id'");
    }
    header("Location: index.php");
}

// --- LOGIKA AMBIL DATA UNTUK EDIT ---
$id_edit = isset($_GET['edit']) ? $_GET['edit'] : '';
$val = ['nama_produk' => '', 'harga' => '', 'stok' => ''];
if ($id_edit) {
    $res = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id_edit'");
    $val = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Form Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2><?= $id_edit ? 'Edit' : 'Tambah'; ?> Produk</h2>
        <form action="admin.php" method="POST" enctype="multipart/form-data" id="formProduk">
            <input type="hidden" name="id" value="<?= $id_edit; ?>">
            <input type="text" name="nama_produk" id="nama" placeholder="Nama Produk" value="<?= $val['nama_produk']; ?>"><br>
            <input type="number" name="harga" id="harga" placeholder="Harga" value="<?= $val['harga']; ?>"><br>
            <input type="number" name="stok" id="stok" placeholder="Stok" value="<?= $val['stok']; ?>"><br>
            <input type="file" name="foto" id="foto"><br>
            <button type="submit" name="simpan">Simpan Data</button>
            <a href="index.php">Batal</a>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>