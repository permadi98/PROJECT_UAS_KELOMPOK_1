<?php
include 'atap_buku.php';
if (isset($_GET['id_kasir'])) {
    $query = $DB_con->query("SELECT * FROM kasir WHERE id_kasir = '$_GET[id_kasir]'");
    $edit  = $query->fetch(PDO::FETCH_ASSOC);
} else {
    echo "kasir tidak tersedia!
<a href='kasir.php' class='btn btn-danger'>Kembali</a>";
    exit();
}
 
if ($edit === false) {
    include 'header';
    echo "Data tidak ditemukan!
<a href='kasir.php' class='btn btn-danger'>Kembali</a>";
    exit();
}
?>

 <div class="container-fluid">
                <div class="side-body">
				
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
<?php
if(isset($_POST['edit'])){
			$id_kasir = $_POST['id_kasir'];
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$telepon = $_POST['telepon'];
			$status = $_POST['status'];
			$username = $_POST['username'];
			
			$password = $_POST['password'];	
			$cek = $DB_con->prepare("SELECT * FROM kasir WHERE id_kasir='$id_kasir' AND password='$password'");
			$cek->execute();
			$jmldata = $cek->rowCount();
			if($jmldata == 0){
					echo '<div class="alert alert-danger fresh-color alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password salah, masukan kembali password dari akun '.$username.' dengan benar..!!</div>';
			}else{
			$update = $DB_con->prepare("UPDATE kasir SET nama='$nama', alamat='$alamat', telepon='$telepon', status='$status', username='$username'
											 WHERE id_kasir='$id_kasir'");
				if($update->execute()){
				echo"<script>alert('data berhasil dirubah, silahkan masuk kembali..!!');
				document.location.href='../logout.php'; </script>\n";
				} else {
?>
				<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					data kasir gagal dirubah..!!
<?php
							}
						}
					}
?>

								<div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Edit Kasir</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-edit"></span> <span class="icon fa fa-user"></span><span class="title">  Edit Kasir</span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<table class="table table-hover" style="width:60%;" align="center">
									<tr>
										<td><label for="gambar" class="control-label">gambar</label></td>
										<td><div class="col-sm-12">
										<img src="<?php echo $edit['gambar']; ?>" class="img-responsive" style="max-height:150px;">
										</div></td>
									<tr>
									<tr>
										<td><input type="hidden" name="id_kasir" value="<?php echo $edit['id_kasir']; ?>" /></td>
										<td><div class="col-sm-12">
										<a href="ganti_gambar_kasir.php?id_kasir=<?php echo $edit['id_kasir'] ?>" type="button" class="btn btn-success" style="color:#fff;"><span class="icon fa fa-image"></span> Ganti Gambar</a>
										</div></td>
									</tr>
									<tr>
										<td><label for="nama" class="control-label">Nama Kasir</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" style="min-width:145px" name="nama" id="nama" value="<?php echo $edit['nama']; ?>" placeholder="nama kasir">
										</div></td>
									</tr>
									<tr>
										<td><label for="alamat" class="control-label">Alamat</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $edit['alamat']; ?>" placeholder="alamat">
										</div></td>
									</tr>
									<tr>
										<td><label for="telepon" class="control-label">No. Telepon</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="telepon" id="telepon" value="<?php echo $edit['telepon']; ?>" placeholder="no telepon">
										</div></td>
									</tr>
									<tr>
										<td><label for="status" class="control-label">Status</label></td>
										<td><div class="col-sm-6">
										<select name="status" class="form-control" id="status" required>
										<option value="">- status terbaru -</option>
										<option value="Menikah">Menikah</option>
										<option value="Belum Menikah">Belum Menikah</option>
										</select>
										</div>
										<div class="col-sm-6">
										<b>Status Sekarang :</b> <span class="label label-info" style="font-size:15px;"><?php echo $edit['status']; ?></span>
										</div>
										</td>
									</tr>
									<tr>
										<td><label for="username" class="control-label">Username</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="username" id="username" value="<?php echo $edit['username']; ?>" placeholder="username">
										</div></td>
									</tr>
									
									<tr>
										<td><label for="password" class="control-label">Password</label></td>
										<td>
										<div class="col-sm-8">
										<input type="password" class="form-control" name="password" id="password" placeholder="masukan password akun <?php echo $edit['username']; ?> untuk verifikasi" title="masukan password akun <?php echo $edit['username']; ?> untuk verifikasi" required>
										</div>
										<div class="col-sm-4">
										<a href="password.php?id_kasir=<?php echo $edit['id_kasir'] ?>" type="button" class="btn btn-warning col-sm-12" style="color:#fff;"><span class="icon fa fa-lock"></span> Ganti Password</a>
										</div>
										</td>
									</tr>
									<tr>
										<td></td>
										<td><div class="col-sm-12"><button class="btn btn-success" type="submit" name="edit"><span class="icon fa fa-save"></span> Simpan</button>
										
										<a href="index.php" type="button" class="btn btn-danger" style="color:#fff;"><span class="icon fa fa-repeat"></span> Kembali</a>
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