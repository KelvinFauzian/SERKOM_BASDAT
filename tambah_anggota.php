<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Tambah Anggota</h2>

    <!-- Button Kembali ke Daftar Anggota -->
    <a href="anggota.php" class="btn btn-secondary mb-3">Kembali ke Daftar Anggota</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Proses form saat tombol submit ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_anggota = $_POST['nama_anggota'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        
        $tgl_masuk = $_POST['tgl_masuk'];

        // Validasi tanggal lahir harus lebih awal dari tanggal masuk
        if (strtotime($tgl_masuk) < strtotime($tgl_lahir)) {
            echo "<div class='alert alert-danger'>Error: Tanggal masuk tidak boleh lebih awal dari tanggal lahir.</div>";
        } else {
            // Query untuk memasukkan data ke tabel anggota
            $sql = "INSERT INTO anggota (nama_anggota, tempat_lahir, tgl_lahir, jenis_kelamin, alamat, tgl_masuk) 
                    VALUES ('$nama_anggota', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$alamat', '$tgl_masuk')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Anggota berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        $conn->close();
    }
    ?>

    <!-- Form Tambah Anggota -->
    <form action="tambah_anggota.php" method="post">
        <div class="form-group">
            <label for="nama_anggota">Nama Anggota:</label>
            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" required>
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
        </div>
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="datetime-local" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="tgl_masuk">Tanggal Masuk:</label>
            <input type="datetime-local" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?php echo $row['tgl_masuk']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>

    </form>
</div>

</body>
</html>
