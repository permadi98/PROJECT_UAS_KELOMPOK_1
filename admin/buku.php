<?php
include 'atap_buku.php';
?>
<?php
  $batas=5; 
$halaman=@$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
  $posisi=0;
  $halaman=1;
}else{
  $posisi=($halaman-1)* $batas;
}
?>

            <div class="container-fluid">
                <div class="side-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title col-xs-12">
									<br>
                                    <div class="title">Data Buku</div>
									<br>
                                    </div>
									<div class="col-sm-10">
										<a href="tambah_buku.php" type="button" class="btn btn-primary col-sm-2"><span class="glyphicon glyphicon-plus"></span> Tambah Buku</a>
									</div>
									<div class="col-sm-2">
									<form action="" method="get">
									  <input type="text" class="form-control" placeholder="Cari disini..." style="border-color:#9900ff;" name="cari" title="cari berdasarkan judul atau nama penulis">
									</form>
									</div>
									<br>
                                </div>
                                <div class="card-body">
									<div class="table-responsive">
                                    <table class="table table-hover table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><center>ID</th>
                                                <th><center>Judul Buku</th>
                                                <th><center>No.ISBN</th>
                                                <th><center>Penulis</th>
                                                <th><center>Penerbit</th>
                                                <th><center>Tahun</th>
                                                <th><center>Stok</th>
                                                <th><center>Harga Pokok</th>
                                                <th><center>PPN</th>
                                                <th><center>Diskon</th>
                                                <th><center>Harga Jual</th>
                                                <th><center>Cover</th>
                                                <th><center>Aksi</th>
                                            </tr>
                                        </thead>
								<?php
								
								if(!isset($_GET['cari'])){
								$sql = "SELECT * FROM buku order by id_buku DESC LIMIT $posisi, $batas";
   
								foreach ($DB_con->query($sql) as $data) :
								?>
                                        <tbody>
                                            <tr style="height:110px;">
                                                <td width="5px" align="center"><?php echo $data['id_buku'] ?></td>
                                                <td width="200px" align="center"><?php echo $data['judul'] ?></td>
                                                <td width="120px" align="center"><?php echo $data['noisbn'] ?></td>
                                                <td width="125px" align="center"><?php echo $data['penulis'] ?></td>
                                                <td width="125px" align="center"><?php echo $data['penerbit'] ?></td>
                                                <td width="10px" align="center"><?php echo $data['tahun'] ?></td>
                                                <td width="10px" align="center"><?php echo $data['stok'] ?></td>
                                                <td width="100px" align="center">Rp.<?php echo number_format($data['harga_pokok'],2,",",".");?></td>
                                                <td width="10px" align="center"><?php echo $data['ppn'] ?></td>
                                                <td width="10px" align="center"><?php echo $data['diskon'] ?></td>
                                                <td width="100px" align="center">Rp.<?php echo number_format($data['harga_jual'],2,",",".");?></td>
                                                <td width="100px" align="center"><img class="gambar" style="width:100px;" src = '<?php echo $data['cover'] ?>'></td>
												<td width="120px" align="center">
												<a href="edit_buku.php?id_buku=<?php echo $data['id_buku'] ?>" type="button" class="btn btn-success" style="color:#fff; margin-bottom:5px;" title="Ubah"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
												<a href="hapus.php?id_buku=<?php echo $data['id_buku'] ?>" onclick="return confirm('Anda yakin akan menghapus data buku ini?')" type="button" class="btn btn-danger" style="color:#fff; margin-bottom:5px;" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
												<a href="cart.php?act=add&amp;id_buku=<?php echo $data['id_buku'] ?>&amp;ref=buku.php"  onclick="return alert('klik menu keranjang untuk melakukan transaksi atau pilih buku lain untuk dijual..!!')" type="button" class="btn btn-warning" style="color:#fff; margin-bottom:5px;" title="Jual"><span class="glyphicon glyphicon-shopping-cart"></span></a>
												<a href="tambah_stok.php?id_buku=<?php echo $data['id_buku'] ?>" type="button" class="btn btn-info" style="color:#fff; margin-bottom:5px;" title="Tambah Stok"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
												</td>
											</tr>
                                        </tbody>
										
								<?php
								endforeach;
								} else if(isset($_GET['cari'])){
								$cari = $_GET['cari'];
								$sql = "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR penulis LIKE '%$cari%' order by id_buku DESC LIMIT $posisi, $batas";
   
								foreach ($DB_con->query($sql) as $data) :
								?>
                                        <tbody>
                                            <tr style="height:110px;">
                                                <td width="5px" align="center"><?php echo $data['id_buku'] ?></td>
                                                <td width="200px" align="center"><?php echo $data['judul'] ?></td>
                                                <td width="120px" align="center"><?php echo $data['noisbn'] ?></td>
                                                <td width="125px" align="center"><?php echo $data['penulis'] ?></td>
                                                <td width="125px" align="center"><?php echo $data['penerbit'] ?></td>
                                                <td width="10px" align="center"><?php echo $data['tahun'] ?></td>
                                                <td width="10px" align="center"><?php echo $data['stok'] ?></td>
                                                <td width="100px" align="center">Rp.<?php echo number_format($data['harga_pokok'],2,",",".");?></td>
                                                <td width="10px" align="center"><?php echo $data['ppn'] ?></td>
                                                <td width="10px" align="center"><?php echo $data['diskon'] ?></td>
                                                <td width="100px" align="center">Rp.<?php echo number_format($data['harga_jual'],2,",",".");?></td>
                                                <td width="100px" align="center"><img class="gambar" style="width:100px;" src = '<?php echo $data['cover'] ?>'></td>
												<td width="120px" align="center">
												<a href="edit_buku.php?id_buku=<?php echo $data['id_buku'] ?>" type="button" class="btn btn-success" style="color:#fff; margin-bottom:5px;" title="Ubah"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
												<a href="hapus.php?id_buku=<?php echo $data['id_buku'] ?>" onclick="return confirm('Anda yakin akan menghapus data buku ini?')" type="button" class="btn btn-danger" style="color:#fff; margin-bottom:5px;" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
												<a href="cart.php?act=add&amp;id_buku=<?php echo $data['id_buku'] ?>&amp;ref=buku.php"  onclick="return alert('klik menu keranjang untuk melakukan transaksi atau pilih buku lain untuk dijual..!!')" type="button" class="btn btn-warning" style="color:#fff; margin-bottom:5px;" title="Jual"><span class="glyphicon glyphicon-shopping-cart"></span></a>
												<a href="tambah_stok.php?id_buku=<?php echo $data['id_buku'] ?>" type="button" class="btn btn-info" style="color:#fff; margin-bottom:5px;" title="Tambah Stok"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
												</td>
											</tr>
                                        </tbody>
										
									<?php
									endforeach;
									}
									?>
                                    </table>
								</div>
									


  <?php
  if(!isset($_GET['cari'])){
  $data = $DB_con->prepare("SELECT * FROM buku");
  $data->execute();
  $jmldata = $data->rowCount();
	
			$jml_hal=ceil($jmldata/$batas);
			$halaman=1;
			echo "<ul class='pagination pull-right'>";
			if(isset($_GET["halaman"]))
			{
				$halaman=$_GET["halaman"];
			}
			if($halaman!=1)
			{
				$sebelumnya =$halaman-1;
				echo "<li><a href='buku.php?halaman=1'>|<</a></li>";
				echo "<li><a href='buku.php?halaman=".$sebelumnya."'><</a></li>";
			}
			for($i=1;$i<=$jml_hal;$i++)
			{
				if($i==$halaman)
				{
					echo "<li class='active'><a href='buku.php?halaman=".$i."' style='background:#9900FF;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='buku.php?halaman=".$i."'>".$i."</a></li>";
				}
			}
			if($halaman!=$jml_hal)
			{
				$berikutnya=$halaman+1;
				echo "<li><a href='buku.php?halaman=".$berikutnya."'>></a></li>";
				echo "<li><a href='buku.php?halaman=".$jml_hal."'>>|</a></li>";
			}
			echo "</ul>";
  } else if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
  $data = $DB_con->prepare("SELECT * FROM buku WHERE judul LIKE '%$cari%' OR penulis LIKE '%$cari%'");
  $data->execute();
  $jmldata = $data->rowCount();
	
			$jml_hal=ceil($jmldata/$batas);
			$halaman=1;
			echo "<ul class='pagination pull-right'>";
			if(isset($_GET["halaman"]))
			{
				$halaman=$_GET["halaman"];
			}
			if($halaman!=1)
			{
				$sebelumnya =$halaman-1;
				$satu = 1;
				echo "<li><a href='buku.php?halaman=".$satu."&cari=".$cari."'>|<</a></li>";
				echo "<li><a href='buku.php?halaman=".$sebelumnya."&cari=".$cari."'><</a></li>";
			}
			for($i=1;$i<=$jml_hal;$i++)
			{
				if($i==$halaman)
				{
					echo "<li class='active'><a href='buku.php?halaman=".$i."buku.php?cari=".$cari."&cari=".$cari."' style='background:#9900FF;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='buku.php?halaman=".$i."&cari=".$cari."'>".$i."</a></li>";
				}
			}
			if($halaman!=$jml_hal)
			{
				$berikutnya=$halaman+1;
				echo "<li><a href='buku.php?halaman=".$berikutnya."&cari=".$cari."'>></a></li>";
				echo "<li><a href='buku.php?halaman=".$jml_hal."&cari=".$cari."'>>|</a></li>";
			}
			echo "</ul>";
  }
			?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
<?php
include 'alas.php';
?>
