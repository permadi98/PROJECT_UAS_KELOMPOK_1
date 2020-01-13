<?php
ini_set("display_errors",0);
 // Define relative path from this script to mPDF
 $laporan='Laporan Data Buku'; //Beri nama file PDF hasil.
define('_MPDF_PATH','MPDF57/');
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('utf-8', 'A4-L');
 // Create new mPDF Document


//Beginning Buffer to save PHP variables and HTML tags
ob_start();
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak
masalah.-->
<!--CONTOH Code START-->
<?php
include("../koneksi.php");?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Data Buku</title>
</head>
<body>
<table border="0" width="100%">
<tr>
<td align="center" width="20%">
<div align="left"></div>
</td>
<td align="center">  <h2>LAPORAN DATA BUKU</h2>
</td>
<td align="center" width="20%">

</td>
</tr>
</table>
<hr size="4" color="#000000" />    
   <center> 
	<h3>
Laporan Berdasarkan: <?php echo $_POST['berdasar'] ?></h3>
	<?php $tgl=date('d-m-Y');
	echo "Tanggal: $tgl";?>
	<?php
	if($_POST['berdasar']=='Semua Data'){
	$sql = "select * from buku order by id_buku";
	}elseif($_POST['berdasar']=='Pencarian Kata'){
	$field = $_POST['field'];
	$kata = $_POST['kata'];
	$sql = "select * from buku where $field like '%$kata%' order by id_buku ";
	}else{
		$sql = "select * from buku order by id_buku";
		}
	$query = $DB_con->query($sql);
	?>
	</center>
	<center>
	<br>
	<table width="100%" border="0" bgcolor="#000000">
      <tr bgcolor="#FFFFFF"  height="40">
        <th width="5%" scope="col">ID</th>
        <th width="%" scope="col">Judul Buku</th>
        <th width="%" scope="col">No. ISBN</th>
        <th width="%" scope="col">Penulis</th>
        <th width="%" scope="col">Penerbit</th>
        <th width="%" scope="col">Tahun</th>
        <th width="%" scope="col">Stok</th>
        <th width="%" scope="col">Harga Pokok</th>
        <th width="%" scope="col">PPN</th>
        <th width="%" scope="col">Diskon</th>
        <th width="%" scope="col">Harga Jual</th>
      </tr>
      <?php
			
			 while ($data = $query->fetch(PDO::FETCH_ASSOC)){
			echo '<tr bgcolor=white>
              <td align=center>'.$data[id_buku].'</td>
              <td align=center>'.$data[judul].'</td>
              <td align=center>'.$data[noisbn].'</td>
              <td align=center>'.$data[penulis].'</td>
              <td align=center>'.$data[penerbit].'</td>
			  <td align=center>'.$data[tahun].'</td>
			  <td align=center>'.$data[stok].'</td>
			  '; ?>
			  <td align="center">Rp.<?php echo number_format($data['harga_pokok'],2,",",".");?></td>
			  <td align="center"><?php echo $data['ppn'] ?></td>
			  <td align="center"><?php echo $data['diskon'] ?></td>
			  <td align="center">Rp.<?php echo number_format($data['harga_jual'],2,",",".");?></td>
            </tr>
			 <?php
			 }
			 ?>
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