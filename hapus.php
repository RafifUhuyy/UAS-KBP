<?php
require_once 'mobil.php';
if (isset($_GET['id'])) {
    $obj = new Mobil();
    $obj->hapusMobil($_GET['id']);
    header("Location: index.php");
}
?>