<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data anggota berdasarkan ID
    $sql = "DELETE FROM anggota WHERE id_anggota = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Anggota berhasil dihapus');
                window.location.href = 'anggota.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: Gagal menghapus anggota');
                window.location.href = 'anggota.php';
              </script>";
    }

    $conn->close();
} else {
    echo "<script>
            alert('ID anggota tidak valid');
            window.location.href = 'Anggota.php';
          </script>";
}
?>
