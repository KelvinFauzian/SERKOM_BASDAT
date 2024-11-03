<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Perpustakaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .sidebar {
            background-color: #3498db;
            padding: 15px;
            border-radius: 8px;
            color: #fff;
        }
        .sidebar .btn-menu {
            background-color: #2980b9;
            color: #fff;
            text-decoration: none;
            padding: 12px;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }
        .sidebar .btn-menu:hover {
            background-color: #1abc9c;
            color: #ffffff;
        }
        .nav-top {
            text-align: right;
            padding: 10px 0;
        }
        .nav-top a {
            margin: 0 10px;
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }
        .nav-top a:hover {
            color: #e74c3c;
        }
        .content {
            padding: 20px;
            background-color: #ecf0f1;
            border-radius: 8px;
            border: 1px solid #dfe6e9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .content h2 {
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .content h4 {
            text-align: center;
            font-weight: normal;
            color: #34495e;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #2c3e50;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>SISTEM MANAJEMEN PERPUSTAKAAN</h1>
    </div>

    <div class="nav-top">
        <a href="index.php">Beranda</a>
        <a href="user.php">User</a>
        <a href="anggota.php">Anggota</a>
        <a href="buku.php">Buku</a>
        <a href="transaksi.php">Transaksi</a>
    </div>

    <div class="row">
        <div class="col-md-3 sidebar">
            <a href="user.php" class="btn-menu">DAFTAR USER</a>
            <a href="anggota.php" class="btn-menu">DAFTAR ANGGOTA</a>
            <a href="buku.php" class="btn-menu">DAFTAR BUKU</a>
            <a href="transaksi.php" class="btn-menu">DAFTAR TRANSAKSI</a>
        </div>
        
        <div class="col-md-9">
            <div class="content">
                <h2>SELAMAT DATANG</h2>
                <h4>MARI MEMBACA</h4>
                <p>Selamat datang di perpustakaan, tempat di mana ribuan cerita, ilmu pengetahuan, dan wawasan menanti untuk dijelajahi. Membaca bukan hanya sekadar mengisi waktu, tapi sebuah jendela untuk melihat dunia dan memahami beragam perspektif yang luas. Setiap halaman yang dibuka adalah langkah menuju pemahaman baru dan inspirasi yang lebih dalam.</p>
                <p>Mari bersama membangun budaya membaca untuk masa depan yang lebih cerah.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
