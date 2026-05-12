<?php
// Gunakan session untuk proteksi login jika kamu memakainya
require_once 'mobil.php';
$obj = new Mobil();

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
// Ambil detail mobil berdasarkan ID
$data = $obj->detailMobil($id);

// Jika data tidak ditemukan (null), jangan tampilkan error di input, arahkan balik
if (!$data) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Unit - SEWA MOBIL</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Tetap gunakan styling card yang rapi */
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            max-width: 500px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50; }
        .form-group input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-sizing: border-box; 
        }
        .btn-update { 
            background: #4e73df; 
            color: white; 
            border: none; 
            padding: 12px; 
            border-radius: 8px; 
            cursor: pointer; 
            width: 100%; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>SEWA MOBIL</h2>
        <nav>
            <ul>
                <li><a href="index.php" style="color:rgba(255,255,255,0.7); text-decoration:none;">🚗 Unit Garasi</a></li>
                <li class="active">📝 Edit Unit</li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <header>
            <h1 style="margin-bottom: 30px;">Edit Unit</h1>
        </header>

        <div class="form-card">
            <form action="update.php" method="POST">
                <!-- Pastikan nama variabel sesuai dengan kolom tabel mobil di rental_db -->
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                
                <div class="form-group">
                    <label>Nama Mobil</label>
                    <input type="text" name="nama_mobil" value="<?= $data['nama_mobil'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Merk</label>
                    <input type="text" name="merk" value="<?= $data['merk'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Tipe Mobil</label>
                    <input type="text" name="tipe_mobil" value="<?= $data['tipe_mobil'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Harga Sewa (Rp)</label>
                    <input type="number" name="harga_sewa" value="<?= $data['harga_sewa'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Stok Unit</label>
                    <input type="number" name="stok_unit" value="<?= $data['stok_unit'] ?>" required>
                </div>
                
                <button type="submit" class="btn-update">Update Unit</button>
                <a href="index.php" style="display:block; text-align:center; margin-top:15px; color:#858796; text-decoration:none;">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>