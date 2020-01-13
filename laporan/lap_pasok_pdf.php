<?php
ini_set("display_errors",0);
 // Define relative path from this script to mPDF
 $laporan='Laporan Pemasokan Buku'; //Beri nama file PDF hasil.
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
<title>Laporan Pemasokan Buku</title>
</head>
<body>
<table border="0" width="100%">
<tr>
<td align="center" width="20%">
<div align="left"></div>
</td>
<td align="center">  <h2>LAPORAN PEMASOKAN BUKU</h2>
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
	$sql = "select * from pasok order by id_pasok";
	}elseif($_POST['berdasar']=='Tanggal'){
	$dari = $_POST['dari'];
	$ke = $_POST['ke'];
	$sql = "select * from pasok
			where 	(tanggal >= '$dari' and
					tanggal <= '$ke')";
	}else{
		$sql = "select * from pasok order by id_pasok";
		}
	$query = $DB_con->query($sql);
	?>
						
	</center>
	<center>
	<br>
	<table width="100%" border="0" bgcolor="#000000">
      <tr bgcolor="#FFFFFF"  height="40">
        <th width="5%" scope="col">ID</th>
        <th width="%" scope="col">Nama Distributor</th>
        <th width="%" scope="col">Judul Buku</th>
        <th width="%" scope="col">Tanggal</th>
        <th width="%" scope="col">Jumlah</th>
      </tr>
      <?php
			
			 while ($data = $query->fetch(PDO::FETCH_ASSOC)){
				 
						$query2 = $DB_con->query("SELECT * FROM distributor where id_distributor='$data[id_distributor]'");
						$distributor  = $query2->fetch(PDO::FETCH_ASSOC);
						$nama_dist = $distributor['nama_distributor'];
				
						$query3 = $DB_con->query("SELECT * FROM buku where id_buku='$data[id_buku]'");
						$buku  = $query3->fetch(PDO::FETCH_ASSOC);
						$judul = $buku['judul'];

						$tot += $data['jumlah'];
			
						
			echo '<tr bgcolor=white>
              <td align=center>'.$data[id_pasok].'</td>
              <td align=center>'.$nama_dist.'</td>
              <td align=center>'.$judul.'</td>
              <td align=center>'.$data[tanggal].'</td>
              <td align=center>'.$data[jumlah].'</td>
			  </tr>'; 
			}
			echo '<tr bgcolor=white>
			<td colspan="4" align=center><b>Total</b></td>
			<td align=center>'.$tot.'</td>
			</tr>';
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