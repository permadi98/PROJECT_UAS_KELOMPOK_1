<?php
include 'atap_buku.php';
if (isset($_GET['id_buku'])) {
    $query = $DB_con->query("SELECT * FROM buku WHERE id_buku = '$_GET[id_buku]'");
    $pasok  = $query->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Buku tidak tersedia!
<a href='buku.php' class='btn btn-danger'>Kembali</a>";
    exit();
}
 
if ($pasok === false) {
    include 'header';
    echo "Data tidak ditemukan!
<a href='buku.php' class='btn btn-danger'>Kembali</a>";
    exit();
}
?>

 <div class="container-fluid">
                <div class="side-body">
				
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
<?php
if(isset($_POST['pasok'])){
			$id_buku = $_GET['id_buku'];
			$masuk = $_POST['masuk'];
			$tanggal = date("Y-m-d");
			$distributor = $_POST['distributor'];
			$pasok = $DB_con->prepare("INSERT INTO pasok VALUES ('NULL', '$distributor', '$id_buku', '$masuk', '$tanggal')");
			if($pasok->execute()){
			$update = $DB_con->prepare("UPDATE buku SET stok=stok+'$masuk' WHERE id_buku='$id_buku'");
				if($update->execute()){
				echo"<script>alert('buku berhasil ditambahkan..!!');
				document.location.href='buku.php'; </script>\n";
				}
			}else {
?>
				<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					gagal menambahkan buku..!!
<?php
							}
						}
?>

								<div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Tambah Stok</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-plus"></span> <span class="icon fa fa-book"></span><span class="title">  Pasok Buku</span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<table class="table table-hover" style="width:60%;" align="center">
									<tr>
										<td><label for="cover" class="control-label">Cover</label></td>
										<td><div class="col-sm-12">
										<img src="<?php echo $pasok['cover']; ?>" class="img-responsive" style="max-height:150px;">
										</div></td>
									<tr>
									<tr>
										<td><label for="judul" class="control-label">Judul Buku</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" style="min-width:145px" name="judul" id="judul" value="<?php echo $pasok['judul']; ?>" placeholder="judul Buku" disabled>
										</div></td>
									</tr>
									<tr>
										<td><label for="noisbn" class="control-label">No ISBN</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="noisbn" id="noisbn" value="<?php echo $pasok['noisbn']; ?>" placeholder="no isbn" disabled>
										</div></td>
									</tr>
									<tr>
										<td><label for="penulis" class="control-label">Penulis</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="penulis" id="penulis" value="<?php echo $pasok['penulis']; ?>" placeholder="penulis" disabled>
										</div></td>
									</tr>
									<tr>
										<td><label for="stok" class="control-label">Stok Awal</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="stok" id="stok" value="<?php echo $pasok['stok']; ?>" placeholder="stok awal" disabled>
										</div></td>
									</tr>
									<tr>
										<td><label for="distributor" class="control-label">Distributor</label></td>
										<td><div class="col-sm-12">
										<select name="distributor" class="form-control" id="distributor" required autofocus>
										<option value="">Pilih Distributor</option>
										<?php
										$sql = $DB_con->prepare("SELECT * FROM distributor");
										if ($sql->execute()) {
										while ($dist = $sql->fetch(PDO::FETCH_ASSOC)) {
										?>
										<option value="<?php echo $dist['id_distributor'];?>" name="distributor"><?php echo $dist['nama_distributor'];?></option>
										<?php
										}
										}
										?>
										</select>
										</div></td>
									</tr>
									<tr>
										<td><label for="masuk" class="control-label">Masuk Sebanyak</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="masuk" id="masuk" placeholder="jumlah buku yang ditambahkan" required>
										</div></td>
									</tr>
									<tr>
										<td></td>
										<td><div class="col-sm-12"><button class="btn btn-success" type="submit" name="pasok"><span class="icon fa fa-plus"></span> Tambah</button>
										
										<a href="buku.php" type="button" class="btn btn-danger" style="color:#fff;"><span class="icon fa fa-repeat"></span> Kembali</a>
										</div></td>
									</tr>
									</table>
									</form>
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