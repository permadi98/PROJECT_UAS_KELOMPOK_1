<?php
include '../koneksi.php';
if (isset($_GET['id_buku'])) {
    $DB_con->exec("DELETE FROM buku WHERE id_buku = '$_GET[id_buku]'");
}
header("location:buku.php")
?>