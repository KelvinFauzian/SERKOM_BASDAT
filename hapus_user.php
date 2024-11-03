<?php
include 'koneksi.php'; // Pastikan file koneksi sudah benar

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // Query untuk menghapus data user berdasarkan ID
    $sql = "DELETE FROM user WHERE id_user = $id_user";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('User berhasil dihapus');
                window.location.href = 'user.php'; // Kembali ke halaman daftar user
              </script>";
    } else {
        echo "<script>
                alert('Error: Gagal menghapus user');
                window.location.href = 'user.php';
              </script>";
    }

    $conn->close();
} else {
    echo "<script>
            alert('ID user tidak valid');
            window.location.href = 'user.php';
          </script>";
}
?>
