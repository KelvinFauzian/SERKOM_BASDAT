<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Daftar User</h2>
    
    <!-- Tombol Kembali ke Beranda -->
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
    <a href="tambah_user.php" class="btn btn-primary mb-3">Tambah User</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include koneksi database
            include 'koneksi.php';

            // Query untuk mendapatkan data user
            $sql = "SELECT * FROM user";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_user"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["hak_akses"] . "</td>";
                    echo "<td>
                            <a href='edit_user.php?id_user=" . $row["id_user"] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus_user.php?id_user=" . $row["id_user"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Tidak ada data user</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
