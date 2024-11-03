<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data anggota berdasarkan ID
    $sql = "DELETE FROM buku WHERE id_buku = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Buku berhasil dihapus');
                window.location.href = 'buku.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: Gagal menghapus buku');
                window.location.href = 'buku.php';
              </script>";
    }

    $conn->close();
} else {
    echo "<script>
            alert('ID buku tidak valid');
            window.location.href = 'buku.php';
          </script>";
}
?>
