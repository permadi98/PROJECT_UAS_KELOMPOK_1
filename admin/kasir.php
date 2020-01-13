<?php
include 'atap_kasir.php';
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
                                    <div class="title">Data Kasir</div>
									<br>
                                    </div>
									<div class="col-sm-10">
										<a href="tambah_kasir.php" type="button" class="btn btn-primary col-sm-2"><span class="glyphicon glyphicon-plus"></span> Tambah Kasir</a>
									</div>
									<div class="col-sm-2">
									<form action="" method="get">
									  <input type="text" class="form-control" placeholder="Cari disini..." style="border-color:#9900ff;" name="cari" title="cari berdasarkan nama atau username yang digunakan">
									</form>
									</div>
									<br>
                                </div>
                                <div class="card-body">
									<div class="table-responsive">
                                    <table class="table table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><center>ID</th>
                                                <th><center>Nama Kasir</th>
                                                <th><center>Alamat</th>
                                                <th><center>No. Telepon</th>
                                                <th><center>Status</th>
                                                <th><center>Akses</th>
                                                <th><center>Username</th>
                                                <th><center>Gambar Profil</th>
                                                <th><center>Aksi</th>
                                            </tr>
                                        </thead>
								<?php
								
								if(!isset($_GET['cari'])){
								$sql = "SELECT * FROM kasir order by id_kasir DESC LIMIT $posisi, $batas";
   
								foreach ($DB_con->query($sql) as $data) :
								?>
                                        <tbody>
                                            <tr style="height:110px;">
                                                <td width="5px" align="center"><?php echo $data['id_kasir'] ?></td>
                                                <td width="200px" align="center"><?php echo $data['nama'] ?></td>
                                                <td width="300px" align="center"><?php echo $data['alamat'] ?></td>
                                                <td width="125px" align="center"><?php echo $data['telepon'] ?></td>
                                                <td width="125px" align="center"><?php echo $data['status'] ?></td>
                                                <td width="100px" align="center"><?php echo $data['akses'] ?></td>
                                                <td width="100px" align="center"><?php echo $data['username'] ?></td>
                                                <td width="100px" align="center"><img class="gambar" style="width:100px;" src = '<?php echo $data['gambar'] ?>'></td>
												<td width="150px" align="center">
												<a href="edit_kasir.php?id_kasir=<?php echo $data['id_kasir'] ?>" type="button" class="btn btn-success" style="color:#fff; margin-bottom:5px;" title="Ubah"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
												<a href="hapus_kasir.php?id_kasir=<?php echo $data['id_kasir'] ?>" onclick="return confirm('Anda yakin akan menghapus data kasir ini?')" type="button" class="btn btn-danger" style="color:#fff; margin-bottom:5px;" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
												<a href="password.php?id_kasir=<?php echo $data['id_kasir'] ?>" type="button" class="btn btn-warning" style="color:#fff; margin-left:4px; margin-bottom:5px;" title="Ganti Password"><span class="glyphicon glyphicon-lock"></span></a>
												</td>
											</tr>
                                        </tbody>
										
								<?php
								endforeach;
								} else if(isset($_GET['cari'])){
								$cari = $_GET['cari'];
								$sql = "SELECT * FROM kasir WHERE nama LIKE '%$cari%' OR username LIKE '%$cari%' order by id_kasir DESC LIMIT $posisi, $batas";
   
								foreach ($DB_con->query($sql) as $data) :
								?>
                                        <tbody>
                                            <tr style="height:110px;">
                                                <td width="5px" align="center"><?php echo $data['id_kasir'] ?></td>
                                                <td width="200px" align="center"><?php echo $data['nama'] ?></td>
                                                <td width="300px" align="center"><?php echo $data['alamat'] ?></td>
                                                <td width="125px" align="center"><?php echo $data['telepon'] ?></td>
                                                <td width="125px" align="center"><?php echo $data['status'] ?></td>
                                                <td width="100px" align="center"><?php echo $data['akses'] ?></td>
                                                <td width="100px" align="center"><?php echo $data['username'] ?></td>
                                                <td width="100px" align="center"><img class="gambar" style="width:100px;" src = '<?php echo $data['gambar'] ?>'></td>
												<td width="150px" align="center">
												<a href="edit_kasir.php?id_kasir=<?php echo $data['id_kasir'] ?>" type="button" class="btn btn-success" style="color:#fff; margin-bottom:5px;" title="Ubah"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
												<a href="hapus_kasir.php?id_kasir=<?php echo $data['id_kasir'] ?>" onclick="return confirm('Anda yakin akan menghapus data kasir ini?')" type="button" class="btn btn-danger" style="color:#fff; margin-bottom:5px;" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
												<a href="password.php?id_kasir=<?php echo $data['id_kasir'] ?>" type="button" class="btn btn-warning" style="color:#fff; margin-left:4px; margin-bottom:5px;" title="Ganti Password"><span class="glyphicon glyphicon-lock"></span></a>
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
  $data = $DB_con->prepare("SELECT * FROM kasir");
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
				echo "<li><a href='kasir.php?halaman=1'>|<</a></li>";
				echo "<li><a href='kasir.php?halaman=".$sebelumnya."'><</a></li>";
			}
			for($i=1;$i<=$jml_hal;$i++)
			{
				if($i==$halaman)
				{
					echo "<li class='active'><a href='kasir.php?halaman=".$i."' style='background:#9900FF;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='kasir.php?halaman=".$i."'>".$i."</a></li>";
				}
			}
			if($halaman!=$jml_hal)
			{
				$berikutnya=$halaman+1;
				echo "<li><a href='kasir.php?halaman=".$berikutnya."'>></a></li>";
				echo "<li><a href='kasir.php?halaman=".$jml_hal."'>>|</a></li>";
			}
			echo "</ul>";
  } else if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
  $data = $DB_con->prepare("SELECT * FROM kasir WHERE nama LIKE '%$cari%' OR username LIKE '%$cari%'");
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
				echo "<li><a href='kasir.php?halaman=".$satu."&cari=".$cari."'>|<</a></li>";
				echo "<li><a href='kasir.php?halaman=".$sebelumnya."&cari=".$cari."'><</a></li>";
			}
			for($i=1;$i<=$jml_hal;$i++)
			{
				if($i==$halaman)
				{
					echo "<li class='active'><a href='kasir.php?halaman=".$i."kasir.php?cari=".$cari."&cari=".$cari."' style='background:#9900FF;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='kasir.php?halaman=".$i."&cari=".$cari."'>".$i."</a></li>";
				}
			}
			if($halaman!=$jml_hal)
			{
				$berikutnya=$halaman+1;
				echo "<li><a href='kasir.php?halaman=".$berikutnya."&cari=".$cari."'>></a></li>";
				echo "<li><a href='kasir.php?halaman=".$jml_hal."&cari=".$cari."'>>|</a></li>";
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
