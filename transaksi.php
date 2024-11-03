<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        h2 {
            color: #333;
        }
        .btn-primary {
            background-color: #007bff; /* Biru sesuai contoh */
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Biru gelap saat hover */
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #fff;
            border: none;
        }
        .btn-edit:hover {
            background-color: #e0a800;
        }
        .btn-hapus {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        .btn-hapus:hover {
            background-color: #c82333;
        }
        .table th {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Transaksi</h2>

    <!-- Tombol Kembali ke Beranda dan Tambah Transaksi -->
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
    <a href="tambah_transaksi.php" class="btn btn-primary mb-3">Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Username</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Koneksi ke database
            include 'koneksi.php';

            // Query untuk mendapatkan data transaksi
            $sql = "SELECT * FROM transaksi";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_transaksi']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['nama_anggota']}</td>
                            <td>{$row['judul_buku']}</td>
                            <td>{$row['tgl_pinjam']}</td>
                            <td>{$row['tgl_kembali']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a href='edit_transaksi.php?id_transaksi={$row['id_transaksi']}' class='btn btn-edit btn-sm'>Edit</a>
                                <a href='hapus_transaksi.php?id_transaksi={$row['id_transaksi']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\" class='btn btn-hapus btn-sm'>Hapus</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>Tidak ada data transaksi</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
