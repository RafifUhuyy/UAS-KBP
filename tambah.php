<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
    header("Location: login.php");
    exit;
}
require_once 'mobil.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Unit - SEWA MOBIL</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Perbaikan agar kotak pengisian terlihat modern */
        .form-card {
            background: white;
            padding: 40px;
            border-radius: 20px; /* Sudut lebih lembut */
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); /* Bayangan halus */
            max-width: 550px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4e73df;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #eaecf4; /* Warna border lebih soft */
            border-radius: 10px; /* Senada dengan card di dashboard */
            box-sizing: border-box;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }

        .btn-submit {
            background: #4e73df; /* Warna biru senada sidebar */
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #2e59d9;
        }

        .btn-cancel {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #858796;
            font-size: 14px;
        }
        
        .btn-cancel:hover {
            color: #e74a3b;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>SEWA MOBIL</h2>
        <nav>
            <ul>
                <li><a href="index.php" style="color:rgba(255,255,255,0.7); text-decoration:none;">🚗 Unit Garasi</a></li>
                <li class="active">✨ Tambah Unit</li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <header>
            <h1 style="margin-bottom: 10px;">Tambah Unit Baru</h1>
            <p style="color: #858796;">Lengkapi formulir di bawah untuk menambah armada baru ke sistem.</p>
        </header>

        <div class="form-card">
            <form action="simpan.php" method="POST">
                <div class="form-group">
                    <label>Nama Mobil</label>
                    <input type="text" name="nama_mobil" placeholder="Contoh: Avanza" required>
                </div>

                <div class="form-group">
                    <label>Merk Mobil</label>
                    <input type="text" name="merk" placeholder="Contoh: Toyota" required>
                </div>

                <div class="form-group">
                    <label>Tipe Mobil</label>
                    <input type="text" name="tipe_mobil" placeholder="SUV / MPV / Sedan" required>
                </div>

                <div class="form-group">
                    <label>Harga Sewa Per Hari</label>
                    <input type="number" name="harga_sewa" placeholder="Masukkan angka saja" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Unit Tersedia</label>
                    <input type="number" name="stok_unit" placeholder="Contoh: 5" required>
                </div>

                <button type="submit" class="btn-submit">Simpan Unit Baru</button>
                <a href="index.php" class="btn-cancel">Batal dan Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>