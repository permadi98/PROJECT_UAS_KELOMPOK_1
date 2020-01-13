<?php
include 'atap_distributor.php';
?>

		
 <div class="container-fluid">
                <div class="side-body">
				
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
	
<?php
if(isset($_POST['simpan'])){
			
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$telepon = $_POST['telepon'];
							$sql = $DB_con->prepare("INSERT INTO distributor VALUES ('NULL', '$nama', '$alamat', '$telepon')");
							if($sql->execute()){
								echo"<script>alert('distributor berhasil ditambahkan..!!');
								document.location.href='distributor.php'; </script>\n";
							} else {
								?>
								<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  data distributor gagal disimpan ke dalam database..!!
								</div>
								<?php
							}
						}
	?>
	
                                <div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Tambah Distributor</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-plus"></span> <span class="icon fa fa-users"></span><span class="title">  Distributor Baru</span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<table class="table table-hover" style="width:60%;" align="center">
									<tr>
										<td><label for="nama" class="control-label">Nama Distributor</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" style="min-width:145px" name="nama" id="nama" placeholder="nama distributor" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="alamat" class="control-label">Alamat</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat distributor" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="telepon" class="control-label">Telepon</label></td>
										<td><div class="col-sm-12">
										<input type="text" class="form-control" name="telepon" id="telepon" placeholder="no. telepon distributor" required>
										</div></td>
									</tr>
									<tr>
										<td></td>
										<td><div class="col-sm-12"><button class="btn btn-success" type="submit" name="simpan"><span class="icon fa fa-save"></span> Simpan</button>
										
										<a href="distributor.php" type="button" class="btn btn-danger" style="color:#fff;"><span class="icon fa fa-repeat"></span> Kembali</a>
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