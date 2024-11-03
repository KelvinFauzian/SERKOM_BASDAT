<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit Anggota</h2>

    <!-- Button Kembali ke Daftar Anggota -->
    <a href="anggota.php" class="btn btn-secondary mb-3">Kembali ke Daftar Anggota</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Mendapatkan ID anggota dari parameter URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query untuk mendapatkan data anggota berdasarkan ID
        $sql = "SELECT * FROM anggota WHERE id_anggota = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Proses form saat tombol update ditekan
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama_anggota = $_POST['nama_anggota'];
                $tempat_lahir = $_POST['tempat_lahir'];
                $tgl_lahir = $_POST['tgl_lahir'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $alamat = $_POST['alamat'];
                $tgl_masuk = $_POST['tgl_masuk'];

                // Validasi tanggal
                if (strtotime($tgl_masuk) < strtotime($tgl_lahir)) {
                    echo "<div class='alert alert-danger'>Error: Tanggal masuk tidak boleh lebih awal dari tanggal lahir.</div>";
                } else {
                    // Query untuk mengupdate data anggota
                    $sql = "UPDATE anggota SET nama_anggota='$nama_anggota', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', jenis_kelamin='$jenis_kelamin', alamat='$alamat', tgl_masuk='$tgl_masuk' WHERE id_anggota=$id";

                    if ($conn->query($sql) === TRUE) {
                        echo "<div class='alert alert-success'>Anggota berhasil diperbarui</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                    }
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Data anggota tidak ditemukan</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>ID anggota tidak diset</div>";
    }
    ?>

    <!-- Form Edit Anggota -->
    <?php if (!empty($row)) { ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama_anggota">Nama Anggota:</label>
            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="<?php echo $row['nama_anggota']; ?>" required>
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $row['tempat_lahir']; ?>" required>
        </div>
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="datetime-local" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $row['tgl_lahir']; ?>" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="L" <?php echo ($row['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                <option value="P" <?php echo ($row['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
        </div>
        <div class="form-group">
            <label for="tgl_masuk">Tanggal Masuk:</label>
            <input type="datetime-local" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?php echo $row['tgl_masuk']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <?php } ?>

</div>

</body>
</html>
