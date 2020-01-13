<?php
include '../koneksi.php';
if (isset($_GET['id_distributor'])) {
    $DB_con->exec("DELETE FROM distributor WHERE id_distributor = '$_GET[id_distributor]'");
}
header("location:distributor.php")
?>