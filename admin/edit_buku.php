<?php
include 'atap_buku.php';
if (isset($_GET['id_buku'])) {
    $query = $DB_con->query("SELECT * FROM buku WHERE id_buku = '$_GET[id_buku]'");
    $edit  = $query->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Buku tidak tersedia!
<a href='buku.php' class='btn btn-danger'>Kembali</a>";
    exit();
}
 
if ($edit === false) {
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
if(isset($_POST['edit'])){
			$id_buku = $_POST['id_buku'];
			$judul = $_POST['judul'];
			$noisbn = $_POST['noisbn'];
			$penulis = $_POST['penulis'];
			$penerbit = $_POST['penerbit'];
			$tahun = $_POST['tahun'];
			$harga_pokok = $_POST['harga_pokok'];
			$ppn = $_POST['ppn'];
			$diskon = $_POST['diskon'];
			$harga_jual = ($_POST['harga_pokok']+($_POST['harga_pokok']*$_POST['ppn']/100)-($_POST['harga_pokok']*$_POST['diskon']/100));
				$update = $DB_con->prepare("UPDATE buku SET judul='$judul', noisbn='$noisbn', penulis='$penulis', penerbit='$penerbit', tahun='$tahun'
											, harga_pokok='$harga_pokok', ppn='$ppn', diskon='$diskon', harga_jual='$harga_jual' WHERE id_buku='$id_buku'");
				if($update->execute()){
				echo"<script>alert('data buku berhasil dirubah..!!');
				document.location.href='buku.php'; </script>\n";
				} else {
?>
				<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					data buku gagal dirubah..!!
<?php
							}
						}
?>

								<div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Edit Buku</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-edit"></span> <span class="icon fa fa-book"></span><span class="title">  Edit Buku</span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<table class="table table-hover" style="width:60%;" align="center">
									<tr>
										<td><label for="cover" class="control-label">Cover</label></td>
										<td><div class="col-sm-12">
										<img src="<?php echo $edit['cover']; ?>" class="img-responsive" style="max-height:150px;">
										</div></td>
									<tr>
									<tr>
										<td><input type="hidden" name="id_buku" value="<?php echo $edit['id_buku']; ?>" /></td>
										<td><div class="col-sm-12">
										<a href="ganti_gambar.php?id_buku=<?php echo $edit['id_buku'] ?>" type="button" class="btn btn-success" style="color:#fff;"><span class="icon fa fa-image"></span> Ganti Gambar</a>
										</div></td>
									</tr>
									<tr>
										<td><label for="judul" class="control-label">Judul Buku</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" style="min-width:145px" name="judul" id="judul" value="<?php echo $edit['judul']; ?>" placeholder="judul Buku">
										</div></td>
									</tr>
									<tr>
										<td><label for="noisbn" class="control-label">No ISBN</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="noisbn" id="noisbn" value="<?php echo $edit['noisbn']; ?>" placeholder="no isbn">
										</div></td>
									</tr>
									<tr>
										<td><label for="penulis" class="control-label">Penulis</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="penulis" id="penulis" value="<?php echo $edit['penulis']; ?>" placeholder="penulis">
										</div></td>
									</tr>
									<tr>
										<td><label for="penerbit" class="control-label">Penerbit</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="penerbit" id="penerbit" value="<?php echo $edit['penerbit']; ?>" placeholder="penerbit">
										</div></td>
									</tr>
									<tr>
										<td><label for="tahun" class="control-label">Tahun</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $edit['tahun']; ?>" placeholder="tahun">
										</div></td>
									</tr>
									<tr>
										<td><label for="harga_pokok" class="control-label">Harga Pokok</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="harga_pokok" id="harga_pokok" value="<?php echo $edit['harga_pokok']; ?>" placeholder="harga pokok">
										</div></td>
									</tr>
									<tr>
										<td><label for="ppn" class="control-label">PPN</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="ppn" id="ppn" value="<?php echo $edit['ppn']; ?>" placeholder="ppn">
										</div></td>
									</tr>
									<tr>
										<td><label for="diskon" class="control-label">Diskon</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="diskon" id="diskon" value="<?php echo $edit['diskon']; ?>" placeholder="diskon">
										</div></td>
									</tr>
									<tr>
										<td><label for="harga_jual" class="control-label">Harga Jual</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="harga_jual" id="harga_jual" value="<?php echo $edit['harga_jual']; ?>" placeholder="harga jual" title="harga jual akan berubah otomatis setelah data disimpan!" disabled>
										</div></td>
									</tr>
									<tr>
										<td></td>
										<td><div class="col-sm-12"><button class="btn btn-success" type="submit" name="edit"><span class="icon fa fa-save"></span> Simpan</button>
										
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