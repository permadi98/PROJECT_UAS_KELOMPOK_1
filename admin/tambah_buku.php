<?php
include 'atap_buku.php';
?>

		
 <div class="container-fluid">
                <div class="side-body">
				
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
	
<?php
if(isset($_POST['simpan'])){
			$buku = $DB_con->query("SELECT MAX(id_buku) AS id FROM buku");
			$b = $buku->fetch(PDO::FETCH_ASSOC);
			$jmldata=$b['id'];
			$id_buku = $jmldata+1;
			$file = $_FILES['cover']['name'];
			$size = $_FILES['cover']['size'];
			$type = array('jpg', 'png', 'ico', 'bmp', 'gif');
			$file_ext = strtolower(end(explode('.', $file)));
			$tmp = $_FILES['cover']['tmp_name'];
			$target = '../img/'.$file;
			$judul = $_POST['judul'];
			$noisbn = $_POST['noisbn'];
			$penulis = $_POST['penulis'];
			$penerbit = $_POST['penerbit'];
			$tahun = $_POST['tahun'];
			$stok = $_POST['stok'];
			$harga_pokok = $_POST['harga_pokok'];
			$ppn = $_POST['ppn'];
			$diskon = $_POST['diskon'];
			$harga_jual = ($_POST['harga_pokok']+($_POST['harga_pokok']*$_POST['ppn']/100)-($_POST['harga_pokok']*$_POST['diskon']/100));
			$tanggal = date("Y-m-d");
			$distributor = $_POST['distributor'];
				if ($size <= 9999999999999) {
				if(in_array($file_ext, $type) === true){
						if (move_uploaded_file($tmp, $target)) {
							$sql = $DB_con->prepare("INSERT INTO buku VALUES ('$id_buku', '$judul', '$noisbn', '$penulis', '$penerbit', '$tahun', '$stok', '$harga_pokok', '$ppn', '$diskon', '$harga_jual', '$target')");
							if($sql->execute()){
								$sql2 = $DB_con->prepare("INSERT INTO pasok VALUES ('NULL', '$distributor', '$id_buku', '$stok', '$tanggal')");
								if($sql2->execute()){
								echo"<script>alert('Buku berhasil ditambahkan..!!');
								document.location.href='buku.php'; </script>\n";
								}
							} else {
								?>
								<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  data buku gagal disimpan ke dalam database..!!
								</div>
								<?php
							}
						}
					}
				}
			}
	?>
	
                                <div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Tambah Buku</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-plus"></span> <span class="icon fa fa-book"></span><span class="title">  Buku Baru</span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<table class="table table-hover" style="width:60%;" align="center">
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
										<td><label for="judul" class="control-label">Judul Buku</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" style="min-width:145px" name="judul" id="judul" placeholder="judul Buku" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="noisbn" class="control-label">No ISBN</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="noisbn" id="noisbn" placeholder="no isbn" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="penulis" class="control-label">Penulis</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="penulis" id="penulis" placeholder="penulis" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="penerbit" class="control-label">Penerbit</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="penerbit" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="tahun" class="control-label">Tahun Terbit</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="tahun" id="tahun" placeholder="tahun terbit" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="stok" class="control-label">Stok</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="stok" id="stok" placeholder="stok" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="harga_pokok" class="control-label">Harga Pokok</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="harga_pokok" id="harga_pokok" placeholder="harga pokok" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="ppn" class="control-label">PPN</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="ppn" id="ppn" placeholder="ppn">
										</div></td>
									</tr>
									<tr>
										<td><label for="diskon" class="control-label">Diskon</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="diskon" id="diskon" placeholder="diskon">
										</div></td>
									</tr>
									<tr>
										<td><label for="harga_jual" class="control-label">Harga Jual</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="harga_jual" id="harga_jual" placeholder="harga jual" title="harga jual akan terisi otomatis setelah data disimpan!" disabled>
										</div></td>
									</tr>
									<tr>
										<td><label for="cover" class="control-label">Cover</label></td>
										<td><div class="col-sm-12">
										<input type="file" id="cover" class="form-control" name="cover" data-toggle="tooltip" data-placement="bottom" title="pilih gambar untuk dijadikan cover!">
										</div></td>
									</tr>
									<tr>
										<td></td>
										<td><div class="col-sm-12"><button class="btn btn-success" type="submit" name="simpan"><span class="icon fa fa-save"></span> Simpan</button>
										
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
<?php
include 'alas.php';
?>