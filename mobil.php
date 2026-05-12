<?php
require_once 'config.php';

class Mobil extends Database {
    
    public function __construct() {
        parent::__construct();
    }

    // ==========================================
    // 1. FUNGSI AUTHENTICATION (LOGIN)
    // ==========================================
    public function loginUser($username, $password) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Menggunakan perbandingan langsung sesuai metode darurat sebelumnya
            if ($password == $user['password']) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['admin_user'] = $user['username'];
                return true;
            }
        }
        return false;
    }

    // ==========================================
    // 2. FUNGSI MANAGEMENT UNIT (GARASI)
    // ==========================================
    public function tampilMobil() {
        $query = "SELECT * FROM mobil ORDER BY id DESC";
        return $this->conn->query($query);
    }

    public function detailMobil($id) {
        $query = "SELECT * FROM mobil WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function tambahMobil($nama, $merk, $tipe, $harga, $stok) {
        $query = "INSERT INTO mobil (nama_mobil, merk, tipe_mobil, harga_sewa, stok_unit) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssid", $nama, $merk, $tipe, $harga, $stok);
        return $stmt->execute();
    }

    public function updateMobil($id, $nama, $merk, $tipe, $harga, $stok) {
        $query = "UPDATE mobil SET nama_mobil=?, merk=?, tipe_mobil=?, harga_sewa=?, stok_unit=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssidi", $nama, $merk, $tipe, $harga, $stok, $id);
        return $stmt->execute();
    }

    public function hapusMobil($id) {
        $query = "DELETE FROM mobil WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // ==========================================
    // 3. FUNGSI SISTEM SEWA (DIPINJAM)
    // ==========================================
    
    // Fungsi untuk memproses sewa & mengurangi stok otomatis
    public function sewaMobil($nama_penyewa, $mobil_id, $lama_sewa) {
        // Ambil info mobil untuk hitung total bayar dan cek stok
        $mobil = $this->detailMobil($mobil_id);
        $total_bayar = $mobil['harga_sewa'] * $lama_sewa;
        
        if ($mobil['stok_unit'] > 0) {
            // A. Masukkan data ke tabel penyewaan
            $querySewa = "INSERT INTO penyewaan (nama_penyewa, mobil_id, lama_sewa, total_bayar) VALUES (?, ?, ?, ?)";
            $stmtSewa = $this->conn->prepare($querySewa);
            $stmtSewa->bind_param("siid", $nama_penyewa, $mobil_id, $lama_sewa, $total_bayar);
            
            if ($stmtSewa->execute()) {
                // B. Kurangi stok di tabel mobil (Logika Pengurangan Stok)
                $queryUpdateStok = "UPDATE mobil SET stok_unit = stok_unit - 1 WHERE id = ?";
                $stmtUpdate = $this->conn->prepare($queryUpdateStok);
                $stmtUpdate->bind_param("i", $mobil_id);
                return $stmtUpdate->execute();
            }
        }
        return false; // Gagal jika stok habis
    }

    // Fungsi untuk menampilkan daftar siapa saja yang meminjam
    public function tampilPenyewaan() {
        // Menggunakan JOIN agar bisa mengambil Nama Mobil dari tabel sebelah
        $query = "SELECT p.*, m.nama_mobil, m.merk, m.tipe_mobil 
                FROM penyewaan p 
                JOIN mobil m ON p.mobil_id = m.id 
                ORDER BY p.tgl_sewa DESC";
        return $this->conn->query($query);
    }
}
?>