<?php
// Include koneksi database
include 'koneksi.php';

// Cek apakah parameter id_transaksi ada
if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Query untuk menghapus transaksi berdasarkan id_transaksi
    $sql = "DELETE FROM transaksi WHERE id_transaksi = $id_transaksi";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Transaksi berhasil dihapus'); window.location.href='transaksi.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus transaksi: " . $conn->error . "'); window.location.href='transaksi.php';</script>";
    }
} else {
    echo "<script>alert('ID Transaksi tidak ditemukan'); window.location.href='transaksi.php';</script>";
}

$conn->close();
?>
