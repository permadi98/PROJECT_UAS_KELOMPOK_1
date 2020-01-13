<?php
include '../koneksi.php';
if (isset($_GET['id_kasir'])) {
    $DB_con->exec("DELETE FROM kasir WHERE id_kasir = '$_GET[id_kasir]'");
}
echo"<script>alert('data berhasil dihapus, silahkan masuk kembali..!!');
				document.location.href='../logout.php'; </script>\n";
?>