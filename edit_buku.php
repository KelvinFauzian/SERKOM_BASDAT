<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit Buku</h2>

    <!-- Button Kembali ke Daftar Buku -->
    <a href="buku.php" class="btn btn-secondary mb-3">Kembali ke Daftar Buku</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Cek apakah parameter id_buku ada
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query untuk mendapatkan data buku berdasarkan id_buku
        $sql = "SELECT * FROM buku WHERE id_buku = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ambil data buku
            $row = $result->fetch_assoc();
            $judul_buku = $row['judul_buku'];
            $pengarang = $row['pengarang'];
            $penerbit = $row['penerbit'];
            $thn_terbit = $row['thn_terbit'];
            $jml_buku = $row['jml_buku'];
        } else {
            echo "<div class='alert alert-danger'>Buku tidak ditemukan.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>ID Buku tidak ditemukan.</div>";
        exit();
    }

    // Proses update data saat form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judul_buku = $_POST['judul_buku'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $thn_terbit = $_POST['thn_terbit'];
        $jml_buku = $_POST['jml_buku'];

        // Validasi tahun terbit
        if (strtotime($thn_terbit) > strtotime(date("Y-m-d"))) {
            echo "<div class='alert alert-danger'>Error: Tahun terbit tidak boleh lebih dari tanggal saat ini.</div>";
        } else {
            // Query untuk update data buku
            $sql = "UPDATE buku SET judul_buku='$judul_buku', pengarang='$pengarang', penerbit='$penerbit', thn_terbit='$thn_terbit', jml_buku='$jml_buku' WHERE id_buku=$id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Buku berhasil diperbarui</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        $conn->close();
    }
    ?>

    <!-- Form Edit Buku -->
    <form action="" method="post">
        <div class="form-group">
            <label for="judul_buku">Judul Buku:</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?php echo $judul_buku; ?>" required>
        </div>
        <div class="form-group">
            <label for="pengarang">Pengarang:</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $pengarang; ?>" required>
        </div>
        <div class="form-group">
            <label for="penerbit">Penerbit:</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $penerbit; ?>" required>
        </div>
        <div class="form-group">
            <label for="thn_terbit">Tahun Terbit:</label>
            <input type="datetime-local" class="form-control" id="thn_terbit" name="thn_terbit" value="<?php echo $thn_terbit; ?>" required>
        </div>
        <div class="form-group">
            <label for="jml_buku">Jumlah Buku:</label>
            <input type="number" class="form-control" id="jml_buku" name="jml_buku" value="<?php echo $jml_buku; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
