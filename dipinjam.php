<?php
session_start();
if (!isset($_SESSION['admin_user'])) { header("Location: login.php"); exit; }
require_once 'mobil.php';
$obj = new Mobil();
$dataSewa = $obj->tampilPenyewaan();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Dipinjam - SEWA MOBIL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>SEWA MOBIL</h2>
        <nav>
            <ul>
                <li><a href="index.php" style="color:rgba(255,255,255,0.6); text-decoration:none;">🚗 Unit Garasi</a></li>
                <li class="active" style="color:white; font-weight:bold; padding:10px 0;">📋 Dipinjam</li>
            </ul>
            <div style="margin-top: 50px; padding: 0 10px;">
                <a href="logout.php" class="btn" style="display: block; text-align: center; background: #e74a3b; color: white; text-decoration: none; padding: 12px; border-radius: 8px; font-weight: bold;">Logout</a>
            </div>
        </nav>
    </div>
    <div class="main-content">
        <h1>Mobil yang Sedang Dipinjam</h1>
        <table style="width:100%; background:white; border-collapse:collapse; border-radius:10px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
            <thead style="background:#4e73df; color:white; text-align:left;">
                <tr>
                    <th style="padding:15px;">Nama Penyewa</th>
                    <th style="padding:15px;">Mobil</th>
                    <th style="padding:15px;">Durasi</th>
                    <th style="padding:15px;">Total Bayar</th>
                    <th style="padding:15px;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $dataSewa->fetch_assoc()): ?>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:15px; font-weight:bold;"><?= $row['nama_penyewa'] ?></td>
                    <td style="padding:15px;"><?= $row['merk'] ?> <?= $row['nama_mobil'] ?> (<?= $row['tipe_mobil'] ?>)</td>
                    <td style="padding:15px;"><?= $row['lama_sewa'] ?> Hari</td>
                    <td style="padding:15px; color:#1cc88a; font-weight:bold;">Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                    <td style="padding:15px; font-size:12px; color:#858796;"><?= $row['tgl_sewa'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>