<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit Transaksi</h2>
    
    <!-- Tombol Kembali ke Daftar Transaksi -->
    <a href="transaksi.php" class="btn btn-secondary mb-3">Kembali ke Daftar Transaksi</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Cek apakah parameter id_transaksi ada
    if (isset($_GET['id_transaksi'])) {
        $id_transaksi = $_GET['id_transaksi'];

        // Query untuk mendapatkan data transaksi berdasarkan id_transaksi
        $sql = "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ambil data transaksi
            $row = $result->fetch_assoc();
            $judul_buku = $row['judul_buku'];
            $nama_anggota = $row['nama_anggota'];
            $tgl_pinjam = $row['tgl_pinjam'];
            $tgl_kembali = $row['tgl_kembali'];
            $status = $row['status'];
        } else {
            echo "<div class='alert alert-danger'>Transaksi tidak ditemukan.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>ID Transaksi tidak ditemukan.</div>";
        exit();
    }

    // Proses update data saat form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judul_buku = $_POST['judul_buku'];
        $nama_anggota = $_POST['nama_anggota'];
        $tgl_pinjam = $_POST['tgl_pinjam'];
        $tgl_kembali = $_POST['tgl_kembali'];
        $status = $_POST['status'];

        // Query untuk update data transaksi
        $sql = "UPDATE transaksi SET judul_buku='$judul_buku', nama_anggota='$nama_anggota', tgl_pinjam='$tgl_pinjam', tgl_kembali='$tgl_kembali', status='$status' WHERE id_transaksi=$id_transaksi";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Transaksi berhasil diperbarui</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Edit Transaksi -->
    <form action="" method="post">
        <div class="form-group">
            <label for="judul_buku">Judul Buku:</label>
            <select class="form-control" id="judul_buku" name="judul_buku" required>
                <!-- Ambil data buku dari database -->
                <?php
                include 'koneksi.php'; // pastikan koneksi sudah ada di sini
                $queryBuku = "SELECT judul_buku FROM buku";
                $resultBuku = $conn->query($queryBuku);
                while ($rowBuku = $resultBuku->fetch_assoc()) {
                    $selected = ($rowBuku['judul_buku'] == $judul_buku) ? "selected" : "";
                    echo "<option value='" . $rowBuku['judul_buku'] . "' $selected>" . $rowBuku['judul_buku'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nama_anggota">Nama Peminjam:</label>
            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="<?php echo $nama_anggota; ?>" required>
        </div>
        <div class="form-group">
            <label for="tgl_pinjam">Tanggal dan Waktu Pinjam:</label>
            <input type="datetime-local" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?php echo date('Y-m-d\TH:i', strtotime($tgl_pinjam)); ?>" required>
        </div>
        <div class="form-group">
            <label for="tgl_kembali">Tanggal dan Waktu Kembali:</label>
            <input type="datetime-local" class="form-control" id="tgl_kembali" name="tgl_kembali" value="<?php echo date('Y-m-d\TH:i', strtotime($tgl_kembali)); ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Dipinjam" <?php if ($status == "Dipinjam") echo "selected"; ?>>Dipinjam</option>
                <option value="Dikembalikan" <?php if ($status == "Dikembalikan") echo "selected"; ?>>Dikembalikan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
