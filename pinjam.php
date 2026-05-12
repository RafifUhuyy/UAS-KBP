<?php
session_start();
if (!isset($_SESSION['admin_user'])) { 
    header("Location: login.php"); 
    exit; 
}
require_once 'mobil.php';
$obj = new Mobil();

// Ambil ID mobil dari parameter URL
$id_mobil = isset($_GET['id']) ? $_GET['id'] : null;
$detail = $obj->detailMobil($id_mobil);

// Jika ID tidak valid atau mobil tidak ditemukan, kembali ke index
if (!$detail) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($obj->sewaMobil($_POST['nama_penyewa'], $_POST['mobil_id'], $_POST['lama_sewa'])) {
        header("Location: dipinjam.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Sewa - SEWA MOBIL</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Desain form senada dengan halaman tambah unit */
        .form-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            max-width: 550px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #4e73df;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #eaecf4;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 15px;
            transition: all 0.3s;
        }

        /* Styling khusus untuk input yang dinonaktifkan (Nama Mobil) */
        .form-group input:disabled {
            background-color: #f8f9fc;
            color: #858796;
            cursor: not-allowed;
            border-style: dashed;
        }

        .form-group input:focus:not(:disabled) {
            outline: none;
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }

        .btn-confirm {
            background: #4e73df;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-confirm:hover {
            background: #2e59d9;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #858796;
            font-size: 14px;
        }

        .btn-back:hover {
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
                <li class="active">📝 Proses Sewa</li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <header>
            <h1 style="margin-bottom: 10px;">Form Penyewaan Mobil</h1>
            <p style="color: #858796;">Silakan isi data pelanggan untuk memproses penyewaan unit.</p>
        </header>

        <div class="form-card">
            <form method="POST">
                <!-- Hidden ID untuk proses di backend -->
                <input type="hidden" name="mobil_id" value="<?= $detail['id'] ?>">

                <div class="form-group">
                    <label>Mobil yang Dipilih</label>
                    <input type="text" value="<?= $detail['merk'] ?> <?= $detail['nama_mobil'] ?> (<?= $detail['tipe_mobil'] ?>)" disabled>
                </div>

                <div class="form-group">
                    <label>Nama Penyewa</label>
                    <input type="text" name="nama_penyewa" placeholder="Masukkan nama lengkap pelanggan" required>
                </div>

                <div class="form-group">
                    <label>Lama Sewa (Hari)</label>
                    <input type="number" name="lama_sewa" placeholder="Contoh: 3" min="1" required>
                </div>

                <button type="submit" class="btn-confirm">Konfirmasi Penyewaan</button>
                <a href="index.php" class="btn-back">Batal dan Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>