<?php
include 'atap.php';
?>

<?php
if(isset($_POST['jual'])){
	$bayar = $_POST['bayar'];
	$kembalian = $_POST['total'];
	$tanggal = date("Y-m-d");
	$kasir = $kasir['id_kasir'];
	 if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $value) {
                    $id_buku = $_SESSION['items'][$key];
                    $jumlah = $value;

                    $query = $DB_con->query("SELECT * FROM buku WHERE id_buku = '$id_buku'");
                    $buku = $query->fetch(PDO::FETCH_ASSOC);
                    $harga = $buku['harga_jual'];

                    $total = $harga * $jumlah;
	$sql = $DB_con->prepare("INSERT INTO penjualan VALUES (NULL, '$id_buku', '$kasir', '$jumlah', '$total', '$tanggal')");
				if($sql->execute()){
				echo"('transaksi penjualan berhasil..!!')";
				
				foreach ($_SESSION['items'] as $key => $val) {
                    unset($_SESSION['items'][$key]);
                }
                unset($_SESSION['items']);
				} else {
?>
				<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					transaksi gagal dilakukan..!!
<?php
							}
						}
					}
				}
?>
<?php
include 'alas.php';
?>