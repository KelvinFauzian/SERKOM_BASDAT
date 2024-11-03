<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Tambah Transaksi</h2>
    
    <!-- Tombol Kembali ke Daftar Transaksi -->
    <a href="transaksi.php" class="btn btn-secondary mb-3">Kembali ke Daftar Transaksi</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    $transaksiBerhasil = false; // Variabel untuk menandai status transaksi

    // Proses form saat tombol submit ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judul_buku = $_POST['judul_buku'];
        $nama_anggota = $_POST['nama_anggota'];
        $tgl_pinjam = $_POST['tgl_pinjam'];
        $tgl_kembali = $_POST['tgl_kembali'];
        $status = $_POST['status'];
        $username = $_POST['username']; // Pastikan username sudah ada di form atau berasal dari sesi login

        // Query untuk memasukkan data transaksi ke tabel
        $sql = "INSERT INTO transaksi (judul_buku, nama_anggota, tgl_pinjam, tgl_kembali, status, username) 
                VALUES ('$judul_buku', '$nama_anggota', '$tgl_pinjam', '$tgl_kembali', '$status', '$username')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Transaksi berhasil ditambahkan</div>";
            $transaksiBerhasil = true; // Set variabel status menjadi true jika berhasil
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Tambah Transaksi, tampilkan hanya jika transaksi belum berhasil -->
    <?php if (!$transaksiBerhasil): ?>
    <form action="tambah_transaksi.php" method="post">
        <div class="form-group">
            <label for="judul_buku">Judul Buku:</label>
            <select class="form-control" id="judul_buku" name="judul_buku" required>
                <!-- Ambil data buku dari database -->
                <?php
                include 'koneksi.php'; // pastikan koneksi sudah ada di sini
                $queryBuku = "SELECT judul_buku FROM buku";
                $resultBuku = $conn->query($queryBuku);
                while ($rowBuku = $resultBuku->fetch_assoc()) {
                    echo "<option value='" . $rowBuku['judul_buku'] . "'>" . $rowBuku['judul_buku'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nama_anggota">Nama Peminjam:</label>
            <select class="form-control" id="nama_anggota" name="nama_anggota" required>
                <!-- Ambil data anggota dari database -->
                <?php
                $queryAnggota = "SELECT nama_anggota FROM anggota";
                $resultAnggota = $conn->query($queryAnggota);
                while ($rowAnggota = $resultAnggota->fetch_assoc()) {
                    echo "<option value='" . $rowAnggota['nama_anggota'] . "'>" . $rowAnggota['nama_anggota'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tgl_pinjam">Tanggal dan Waktu Pinjam:</label>
            <input type="datetime-local" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
        </div>
        <div class="form-group">
            <label for="tgl_kembali">Tanggal dan Waktu Kembali:</label>
            <input type="datetime-local" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Dipinjam">Dipinjam</option>
                <option value="Dikembalikan">Dikembalikan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <select class="form-control" id="username" name="username" required>
                <!-- Ambil data username dari tabel user -->
                <?php
                $queryUser = "SELECT username FROM user";
                $resultUser = $conn->query($queryUser);
                while ($rowUser = $resultUser->fetch_assoc()) {
                    echo "<option value='" . $rowUser['username'] . "'>" . $rowUser['username'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    <?php endif; ?>
</div>

</body>
</html>
