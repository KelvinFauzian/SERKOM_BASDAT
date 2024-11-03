<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit User</h2>

    <!-- Tombol Kembali ke Daftar User -->
    <a href="user.php" class="btn btn-secondary mb-3">Kembali ke Daftar User</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Cek apakah parameter id_user ada
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];

        // Query untuk mendapatkan data user berdasarkan id_user
        $sql = "SELECT * FROM user WHERE id_user = $id_user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ambil data user
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $email = $row['email'];
            $hak_akses = $row['hak_akses'];
        } else {
            echo "<div class='alert alert-danger'>User tidak ditemukan.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>ID User tidak ditemukan.</div>";
        exit();
    }

    // Proses update data saat form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $hak_akses = $_POST['hak_akses'];

        // Jika password diubah, tambahkan di query; jika tidak, lewati
        if (!empty($password)) {
            $sql = "UPDATE user SET username='$username', password='$password', email='$email', hak_akses='$hak_akses' WHERE id_user=$id_user";
        } else {
            $sql = "UPDATE user SET username='$username', email='$email', hak_akses='$hak_akses' WHERE id_user=$id_user";
        }

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>User berhasil diperbarui</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Edit User -->
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password (kosongkan jika tidak ingin diubah):</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="form-group">
            <label for="hak_akses">Hak Akses:</label>
            <select class="form-control" id="hak_akses" name="hak_akses" required>
                <option value="admin" <?php if($hak_akses == "admin") echo "selected"; ?>>Admin</option>
                <option value="user" <?php if($hak_akses == "user") echo "selected"; ?>>User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
