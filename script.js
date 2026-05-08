document.getElementById('formProduk').onsubmit = function(e) {
    let nama = document.getElementById('nama').value;
    let harga = document.getElementById('harga').value;
    let stok = document.getElementById('stok').value;
    let foto = document.getElementById('foto');

    if (nama === "" || harga === "" || stok === "") {
        alert("Harap isi semua kolom!");
        return false;
    }

    if (foto.files.length > 0) {
        let file = foto.files[0];
        let fileType = file.type;
        let fileSize = file.size; // dalam bytes

        if (!['image/jpeg', 'image/jpg', 'image/png'].includes(fileType)) {
            alert("Hanya boleh file gambar (JPG, PNG)!");
            return false;
        }
        if (fileSize > 2 * 1024 * 1024) {
            alert("Ukuran file maksimal 2 MB!");
            return false;
        }
    }
};