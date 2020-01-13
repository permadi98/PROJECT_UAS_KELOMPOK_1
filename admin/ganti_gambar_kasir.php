<?php
include 'atap_kasir.php';
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
if(isset($_POST['simpan'])){
			$file = $_FILES['gambar']['name'];
			$size = $_FILES['gambar']['size'];
			$type = array('jpg', 'png', 'ico', 'bmp', 'gif');
			$file_ext = strtolower(end(explode('.', $file)));
			$tmp = $_FILES['gambar']['tmp_name'];
			$target = '../img/'.$file;
			$username = $edit['username'];
			$id_kasir = $_POST['id_kasir'];	
			$password = $_POST['password'];	
			$cek = $DB_con->prepare("SELECT * FROM kasir WHERE id_kasir='$id_kasir' AND password='$password'");
			$cek->execute();
			$jmldata = $cek->rowCount();
			if($jmldata == 0){
					echo '<div class="alert alert-danger fresh-color alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password salah, masukan kembali password dari akun '.$username.' dengan benar..!!</div>';
			}else{
				if ($size <= 9999999999999) {
				if(in_array($file_ext, $type) === true){
						if (move_uploaded_file($tmp, $target)) {
							$stmt = $DB_con->prepare("UPDATE kasir SET gambar='$target' WHERE id_kasir='$id_kasir'");
							if($stmt->execute()){
								?>
								<script>alert('gambar berhasil dirubah..!!');
								document.location.href='edit_kasir.php?id_kasir=<?php echo $edit['id_kasir'] ?>'; </script><?php
								} else {
								?>
								<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  gambar gagal dirubah..!!
								<?php
							}
						}
					}
				}
			}
		}
	?>
							<div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Edit Gambar</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-image"></span><span class="title">  Edit Gambar Profil <?php echo $edit['username']; ?></span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<div class="form-group">
									<input type="hidden" name="id_kasir" value="<?php echo $edit['id_kasir']; ?>" />
										<label for="gambar" class="col-sm-1 control-label">Gambar</label>
										<div class="col-sm-11">
										<img src="<?php echo $edit['gambar']; ?>" class="img-responsive" style="max-height:300px;">
										</div>
									</div>
									<img src="img/jarak.png">
						
									<div class="form-group">
										<label for="gambar" class="col-sm-1 control-label">Gambar Baru</label>
										<div class="col-sm-11">
										<input type="file" id="gambar" class="form-control" name="gambar" title="pilih gambar untuk dijadikan gambar!" required autofocus>
										</div>
									</div>
									<img src="img/jarak.png">
									
									<div class="form-group">
										<label for="password" class="col-sm-1 control-label">Password</label>
										<div class="col-sm-11">
										<input type="password" class="form-control" name="password" id="password" placeholder="masukan password akun <?php echo $edit['username']; ?> untuk verifikasi" title="masukan password akun <?php echo $edit['username']; ?> untuk verifikasi" required>
										</div>
									</div>
									<img src="img/jarak.png">	
									<div class="form-group">
										<label class="col-sm-1 control-label"></label>
										<div class="col-sm-1">
										<button class="btn btn-success" type="submit" name="simpan"><span class="icon fa fa-save"></span> Simpan</button>
										</div>
										<div class="col-sm-1">
										<a href="edit_kasir.php?id_kasir=<?php echo $edit['id_kasir'] ?>" type="button" class="btn btn-danger" style="color:#fff;"><span class="icon fa fa-repeat"></span> Kembali</a>
										</div>
									</div>
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