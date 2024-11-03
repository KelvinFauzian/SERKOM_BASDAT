<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Tambah Buku</h2>

    <!-- Button Kembali ke Daftar Buku -->
    <a href="buku.php" class="btn btn-secondary mb-3">Kembali ke Daftar Buku</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Proses form saat tombol submit ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judul_buku = $_POST['judul_buku'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $thn_terbit = $_POST['thn_terbit'];
        $jml_buku = $_POST['jml_buku'];
        $tgl_input = $_POST['tgl_input'];

        // Query untuk memasukkan data ke tabel buku
        $sql = "INSERT INTO buku (judul_buku, pengarang, penerbit, thn_terbit, jml_buku, tgl_input) 
                VALUES ('$judul_buku', '$pengarang', '$penerbit', '$thn_terbit', '$jml_buku', '$tgl_input')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Buku berhasil ditambahkan</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Tambah Buku -->
    <form action="tambah_buku.php" method="post">
        <div class="form-group">
            <label for="judul_buku">Judul Buku:</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
        </div>
        <div class="form-group">
            <label for="pengarang">Pengarang:</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" required>
        </div>
        <div class="form-group">
            <label for="penerbit">Penerbit:</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
        </div>
        <div class="form-group">
            <label for="thn_terbit">Tahun Terbit:</label>
            <input type="datetime-local" class="form-control" id="thn_terbit" name="thn_terbit" required>
        </div>
        <div class="form-group">
            <label for="jml_buku">Jumlah Buku:</label>
            <input type="number" class="form-control" id="jml_buku" name="jml_buku" required>
        </div>
        <div class="form-group">
            <label for="tgl_masuk">Tanggal Input:</label>
            <input type="datetime-local" class="form-control" id="tgl_input" name="tgl_input" value="<?php echo $row['tgl_masuk']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

</body>
</html>
