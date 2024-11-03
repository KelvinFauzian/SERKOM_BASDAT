<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function confirmDelete(id) {
            if (confirm("Yakin ingin menghapus data ini?")) {
                window.location.href = "hapus_buku.php?id=" + id;
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
    <h2 class="mt-4">Daftar Buku</h2>

    <!-- Tombol Kembali ke Beranda -->
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
    <!-- Tombol Tambah Buku -->
    <a href="tambah_buku.php" class="btn btn-primary mb-3">Tambah Buku</a>

    <div class="table-container">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tanggal Input</th>
                    <th>Tahun Terbit</th>
                    <th>Jumlah Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $sql = "SELECT * FROM buku";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_buku']}</td>
                                <td>{$row['judul_buku']}</td>
                                <td>{$row['pengarang']}</td>
                                <td>{$row['penerbit']}</td>
                                <td>{$row['tgl_input']}</td>
                                <td>{$row['thn_terbit']}</td>
                                <td>{$row['jml_buku']}</td>
                                <td>
                                    <a href='edit_buku.php?id={$row['id_buku']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <button onclick='confirmDelete({$row['id_buku']})' class='btn btn-danger btn-sm'>Hapus</button>
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
