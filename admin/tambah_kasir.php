<?php
include 'atap_kasir.php';
?>

		
 <div class="container-fluid">
                <div class="side-body">
				
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
	
<?php
if(isset($_POST['simpan'])){
			$file = $_FILES['gambar']['name'];
			$size = $_FILES['gambar']['size'];
			$type = array('jpg', 'png', 'ico', 'bmp', 'gif');
			$file_ext = strtolower(end(explode('.', $file)));
			$tmp = $_FILES['gambar']['tmp_name'];
			$target = '../img/'.$file;
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$telepon = $_POST['telepon'];
			$status = $_POST['status'];
			$username = $_POST['username'];
			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];
			$akses = $_POST['akses'];
				if ($size <= 9999999999999) {
				if(in_array($file_ext, $type) === true){
						if (move_uploaded_file($tmp, $target)) {
							if($password1 == $password2){
							$password = $password1;
							$sql = $DB_con->prepare("INSERT INTO kasir VALUES ('NULL', '$nama', '$alamat', '$telepon', '$status', '$username', '$password', '$akses', '$target')");
							if($sql->execute()){
								echo"<script>alert('kasir berhasil ditambahkan..!!');
								document.location.href='kasir.php'; </script>\n";
								}
							}
						}else{
							echo '<div class="alert alert-danger alert-dismissable fresh-color"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Kasir Gagal Di simpan !</div>';
						}
					} else{
						echo '<div class="alert alert-danger alert-dismissable fresh-color"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama !</div>';
					
						}
					}
				}
	?>
	
                                <div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Tambah Kasir</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-plus"></span> <span class="icon fa fa-user"></span><span class="title">  Kasir Baru</span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<table class="table table-hover" style="width:60%;" align="center">
									<tr>
										<td><label for="nama" class="control-label">Nama Kasir</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" style="min-width:145px" name="nama" id="nama" placeholder="nama kasir" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="alamat" class="control-label">Alamat</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="telepon" class="control-label">No. Telepon</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="telepon" id="telepon" placeholder="no telepon" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="status" class="control-label">Status</label></td>
										<td><div class="col-sm-12">
										<select name="status" class="form-control" id="status" required>
										<option value="">Pilih status</option>
										<option value="Menikah">Menikah</option>
										<option value="Belum Menikah">Belum Menikah</option>
										</select>
										</div></td>
									</tr>
									<tr>
										<td><label for="username" class="control-label">Username</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="username" id="username" placeholder="username" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="password1" class="control-label">Password</label></td>
										<td><div class="col-sm-12">
										<input type="password" class="form-control" name="password1" id="password1" placeholder="password" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="password2" class="control-label">Ulangi Password</label></td>
										<td><div class="col-sm-12">
										<input type="password" class="form-control" name="password2" id="password2" placeholder="ulangi password" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="akses" class="control-label">Akses</label></td>
										<td><div class="col-sm-12">
										<select name="akses" class="form-control" id="akses" required>
										<option value="">Pilih akses</option>
										<option value="kasir">Kasir</option>
										<option value="admin">Admin</option>
										</select>
										</div></td>
									</tr>
									<tr>
										<td><label for="gambar" class="control-label">Gambar Profil</label></td>
										<td><div class="col-sm-12">
										<input type="file" id="gambar" class="form-control" name="gambar" data-toggle="tooltip" data-placement="bottom" title="pilih gambar untuk dijadikan gambar profil!">
										</div></td>
									</tr>
									<tr>
										<td></td>
										<td><div class="col-sm-12"><button class="btn btn-success" type="submit" name="simpan"><span class="icon fa fa-save"></span> Simpan</button>
										
										<a href="kasir.php" type="button" class="btn btn-danger" style="color:#fff;"><span class="icon fa fa-repeat"></span> Kembali</a>
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
<?php
include 'alas.php';
?>