<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function confirmDelete(id) {
            if (confirm("Yakin ingin menghapus data ini?")) {
                window.location.href = "hapus_anggota.php?id=" + id;
            }
        }
    </script>
    <style>
        .table-container {
            margin-top: 20px;
        }
        .btn-primary, .btn-secondary {
            margin-bottom: 10px;
        }
        .table th, .table td {
            text-align: center;
        }
        .btn-warning, .btn-danger {
            width: 70px;
        }
        .btn-danger {
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mt-4">Daftar Anggota</h2>

    <!-- Tombol Kembali ke Beranda -->
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
    <!-- Tombol Tambah Anggota -->
    <a href="tambah_anggota.php" class="btn btn-primary mb-3">Tambah Anggota</a>

    <div class="table-container">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $sql = "SELECT * FROM anggota";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_anggota']}</td>
                                <td>{$row['nama_anggota']}</td>
                                <td>{$row['tempat_lahir']}</td>
                                <td>{$row['tgl_lahir']}</td>
                                <td>{$row['jenis_kelamin']}</td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['tgl_masuk']}</td>
                                <td>
                                    <a href='edit_anggota.php?id={$row['id_anggota']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <button onclick='confirmDelete({$row['id_anggota']})' class='btn btn-danger btn-sm'>Hapus</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
