<?php
require_once 'mobil.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $obj = new Mobil();
    $obj->tambahMobil($_POST['nama_mobil'], $_POST['merk'], $_POST['tipe_mobil'], $_POST['harga_sewa'], $_POST['stok_unit']);
    header("Location: index.php");
}
?>