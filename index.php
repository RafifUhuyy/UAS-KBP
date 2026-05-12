<?php
session_start();
// Proteksi: Jika admin belum login, arahkan ke halaman login
if (!isset($_SESSION['admin_user'])) {
    header("Location: login.php");
    exit;
}

require_once 'mobil.php'; // Menggunakan file model baru
$mobil = new Mobil();
$dataMobil = $mobil->tampilMobil(); // Mengambil data dari rental_db
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>SEWA MOBIL</h2>
        <nav>
            <ul>
                <!-- Menu Unit Garasi Aktif -->
                <li>
                    <a href="index.php" class="nav-link active" style="text-decoration:none; color:inherit; display:block; padding:10px; border-radius:8px; background: rgba(255,255,255,0.1);">
                        🚗 Unit Garasi
                    </a>
                </li>
                <!-- Menu Dipinjam Sekarang Sudah Bisa Diklik -->
                <li>
                    <a href="dipinjam.php" class="nav-link" style="text-decoration:none; color:inherit; display:block; padding:10px; opacity:0.8;">
                        📋 Dipinjam
                    </a>
                </li>
            </ul>
            
            <div style="margin-top: 50px; padding: 0 10px;">
                <!-- Tombol Tambah Unit -->
                <a href="tambah.php" class="btn add-btn" style="display: block; text-align: center; margin-bottom: 10px; background: #4e73df; color: white; text-decoration: none; padding: 12px; border-radius: 8px; font-weight: bold;">
                    + Tambah Unit
                </a>
                
                <!-- Tombol Logout Merah -->
                <a href="logout.php" class="btn" style="display: block; text-align: center; background: #e74a3b; color: white; text-decoration: none; padding: 12px; border-radius: 8px; font-weight: bold;" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                    Logout
                </a>
            </div>
        </nav>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <header>
            <div>
                <h1 style="margin:0;">Management Sewa</h1>
                <p style="color: #858796; margin: 5px 0 0 0;">Pantau dan kelola armada mobil Anda</p>
            </div>
        </header>

        <!-- Grid Container untuk Card Mobil -->
        <div class="grid-container">
            <?php while($row = $dataMobil->fetch_assoc()): ?>
            <div class="item-card">
                <!-- Label Tipe Mobil (SUV/MPV/dll) -->
                <span class="category-tag" style="background: #eef2ff; color: #4e73df; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                    <?= $row['tipe_mobil'] ?>
                </span>
                
                <h3 style="margin: 15px 0 5px 0; color: #2c3e50;">
                    <?= $row['merk'] ?> <?= $row['nama_mobil'] ?>
                </h3>
                
                <div class="price" style="color: #1cc88a; font-size: 1.2rem; font-weight: bold; margin-bottom: 10px;">
                    Rp <?= number_format($row['harga_sewa'], 0, ',', '.') ?> <span style="font-size: 0.8rem; color: #858796;">/ Hari</span>
                </div>
                
                <span class="stock-info" style="color: #858796; font-size: 0.9rem;">
                    Tersedia: <strong style="color: #2c3e50;"><?= $row['stok_unit'] ?> Unit</strong>
                </span>
                
                <!-- Tombol Aksi -->
                <div class="card-actions" style="margin-top: 20px; display: flex; flex-wrap: wrap; gap: 8px;">
                    <!-- Tombol SEWA (Baru) untuk mengurangi stok -->
                    <a href="pinjam.php?id=<?= $row['id'] ?>" class="btn" style="flex: 1 1 100%; text-align: center; background: #1cc88a; color: white; text-decoration: none; padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 5px;">Sewa Sekarang</a>
                    
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit" style="flex: 1; text-align: center; background: #f6c23e; color: white; text-decoration: none; padding: 8px; border-radius: 5px;">Edit</a>
                    
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-del" style="flex: 1; text-align: center; background: #e74a3b; color: white; text-decoration: none; padding: 8px; border-radius: 5px;" onclick="return confirm('Hapus unit ini?')">Hapus</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>