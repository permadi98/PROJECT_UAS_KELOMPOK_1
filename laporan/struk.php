<?php
ini_set("display_errors",0);
 // Define relative path from this script to mPDF
 $laporan='Struk Penjualan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','MPDF57/');
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('utf-8', array(100,148), '8', '5', '5', '5', '5');
 // Create new mPDF Document


//Beginning Buffer to save PHP variables and HTML tags
ob_start();
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak
masalah.-->
<!--CONTOH Code START-->
<?php
include_once '../koneksi.php';
session_start();

if (!isset($_SESSION)) {
        session_start();
    }
?>

<?php
	$query = $DB_con->query("SELECT * FROM kasir WHERE username='$_SESSION[username]' AND password='$_SESSION[password]'");
	$kasir  = $query->fetch(PDO::FETCH_ASSOC);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Struk Penjualan</title>
</head>
<body>
<table border="0" width="100%">
<tr>
<td align="center" width="20%">
<div align="left"></div>
</td>
<td align="center">  <h2>STRUK PENJUALAN</h2>
</td>
<td align="center" width="20%">
<?php
if(isset($_POST['jual'])){
	
	$subtotal = 0;
	$total = 0;
	 if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $value) {
                    $id_buku = $key;
                    $jumlah = $value;

                    $query = $DB_con->query("SELECT * FROM buku WHERE id_buku = '$id_buku'");
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    $harga = $data['harga_jual'];
                    $subtotal = $harga * $jumlah;
					
					$total += $subtotal;
					$bayar = $_POST['bayar'];
					$kembalian = $bayar-$total;
					$tanggal = date("Y-m-d");
					$id_kasir = $kasir['id_kasir'];
					$nama = $kasir['nama'];
					
			$sql = $DB_con->prepare("INSERT INTO penjualan VALUES (NULL, '$id_buku', '$id_kasir', '$jumlah', '$subtotal', '$tanggal')");
				if($sql->execute()){
				echo"<script>alert('transaksi penjualan berhasil..!!');
				document.location.href='struk.php'; </script>\n";
				
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
</td>
</tr>
</table>
<hr size="4" color="#000000" />    
   <center> 
	<h3>Nama Kasir : <?php echo $nama; ?></h3>
   
 <h4>Tanggal : <?php echo $tanggal; ?></h4>
<table width="100%" border="0" cellspacing="0">
  <thead>
    <tr>
    <th><center>Judul Buku</th>
    <th><center>Harga</th>
    <th><center>Jumlah</th>
    <th><center>Sub Total</th>
    </tr>
  </thead>
<?php
$total = 0;
	if (isset($_SESSION['items'])) {
	foreach ($_SESSION['items'] as $key => $val) {
	$query = $DB_con->query("select * from buku where id_buku = '$key'");
	$data = $query->fetch(PDO::FETCH_ASSOC);

	$jumlah_harga = $data['harga_jual'] * $val;
	$total += $jumlah_harga;
?>
  <tbody>
    <tr>
    <td width="" align="center"><?php echo $data['judul'] ?></td>
    <td width="" align="center">Rp.<?php echo number_format($data['harga_jual'],2,",",".");?></td>
    <td width="" align="center"><?php echo number_format($val); ?></td>
	<td width="" align="center">Rp.<?php echo number_format($jumlah_harga,2,",",".");?></td>
    </tr>
	<?php
		}
	}					
	?>
	<tr>
	<td colspan="4"><hr></td>
	</tr>
	<tr>
    <td width="" align="center"><b>Total</b></td>
    <td width="" align="center" colspan="2"></td>
	<td width="" align="center">Rp.<?php echo number_format($total,2,",",".");?></td>
    </tr>
	<tr>
	<td colspan="4"><hr></td>
	</tr>
	<tr>
    <td width="" align="center"><b>Bayar</b></td>
    <td width="" align="center" colspan="2"></td>
	<td width="" align="center">Rp.<?php echo number_format($bayar,2,",",".");?></td>
    </tr>
	<tr>
	<td colspan="4"><hr></td>
	</tr>
	<tr>
    <td width="" align="center"><b>Kembalian</b></td>
    <td width="" align="center" colspan="2"></td>
	<td width="" align="center">Rp.<?php echo number_format($kembalian,2,",",".");?></td>
    </tr>
    </table></center>

</body>
</html>
<!--CONTOH Code FINISH-->
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 justchange FOR
$mpdf->WriteHTML($html);
$mpdf->Output($laporan.".pdf" ,'I');
exit;

?>