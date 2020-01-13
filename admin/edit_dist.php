<?php
include 'atap_distributor.php';
if (isset($_GET['id_distributor'])) {
    $query = $DB_con->query("SELECT * FROM distributor WHERE id_distributor = '$_GET[id_distributor]'");
    $edit  = $query->fetch(PDO::FETCH_ASSOC);
} else {
    echo "distributor tidak tersedia!
<a href='distributor.php' class='btn btn-danger'>Kembali</a>";
    exit();
}
 
if ($edit === false) {
    include 'header';
    echo "Data tidak ditemukan!
<a href='distributor.php' class='btn btn-danger'>Kembali</a>";
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
			$id_distributor = $_POST['id_distributor'];
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$telepon = $_POST['telepon'];
			$update = $DB_con->prepare("UPDATE distributor SET nama_distributor='$nama', alamat='$alamat', telepon='$telepon' WHERE id_distributor='$id_distributor'");
				if($update->execute()){
				echo"<script>alert('data distributor berhasil dirubah..!!');
				document.location.href='distributor.php'; </script>\n";
				} else {
?>
				<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					data distributor gagal dirubah..!!
<?php
							}
						}
?>

								<div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Edit Distributor</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-edit"></span> <span class="icon fa fa-users"></span><span class="title">  Edit Distributor</span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<table class="table table-hover" style="width:60%;" align="center">
									
										<td><label for="nama" class="control-label">Nama Distributor</label></td>
										<td><div class="col-sm-12">
										<input type="hidden" name="id_distributor" value="<?php echo $edit['id_distributor']; ?>" />
										<input type="text" class="form-control" style="min-width:145px" name="nama" id="nama" value="<?php echo $edit['nama_distributor']; ?>" placeholder="nama distributor">
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
										<td></td>
										<td><div class="col-sm-12"><button class="btn btn-success" type="submit" name="edit"><span class="icon fa fa-save"></span> Simpan</button>
										
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
		</div>
<?php
include 'alas.php';
?>