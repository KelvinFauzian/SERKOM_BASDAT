<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Tambah User</h2>
    
    <!-- Tombol Kembali ke Daftar User -->
    <a href="user.php" class="btn btn-secondary mb-3">Kembali ke Daftar User</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Proses form saat tombol submit ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $hak_akses = $_POST['hak_akses'];

        // Query untuk memasukkan data user ke tabel
        $sql = "INSERT INTO user (username, password, email, hak_akses) 
                VALUES ('$username', '$password', '$email', '$hak_akses')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>User berhasil ditambahkan</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Tambah User -->
    <form action="tambah_user.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="hak_akses">Hak Akses:</label>
            <select class="form-control" id="hak_akses" name="hak_akses" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

</body>
</html>
