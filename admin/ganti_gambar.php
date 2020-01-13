<?php
include 'atap_buku.php';
if (isset($_GET['id_buku'])) {
    $query = $DB_con->query("SELECT * FROM buku WHERE id_buku = '$_GET[id_buku]'");
    $edit  = $query->fetch(PDO::FETCH_ASSOC);
} else {
    echo "buku tidak tersedia!
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
if(isset($_POST['simpan'])){
			$file = $_FILES['cover']['name'];
			$size = $_FILES['cover']['size'];
			$type = array('jpg', 'png', 'ico', 'bmp', 'gif');
			$file_ext = strtolower(end(explode('.', $file)));
			$tmp = $_FILES['cover']['tmp_name'];
			$target = '../img/'.$file;
			$id_buku = $_POST['id_buku'];
				if ($size <= 9999999999999) {
				if(in_array($file_ext, $type) === true){
						if (move_uploaded_file($tmp, $target)) {
							$stmt = $DB_con->prepare("UPDATE buku SET cover='$target' WHERE id_buku='$id_buku'");
							if($stmt->execute()){
								?>
								<script>alert('Cover berhasil dirubah..!!');
								document.location.href='edit_buku.php?id_buku=<?php echo $edit['id_buku'] ?>'; </script><?php
								} else {
								?>
								<div class="alert alert-warning alert-dismissible fresh-color" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  Cover gagal dirubah..!!
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
                                    <div class="title">&nbsp;Edit Cover</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-image"></span><span class="title">  Edit Cover</span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<div class="form-group">
									<input type="hidden" name="id_buku" value="<?php echo $edit['id_buku']; ?>" />
										<label for="cover" class="col-sm-1 control-label">Cover</label>
										<div class="col-sm-11">
										<img src="<?php echo $edit['cover']; ?>" class="img-responsive" style="max-height:300px;">
										</div>
									</div>
									<img src="img/jarak.png">
						
									<div class="form-group">
										<label for="cover" class="col-sm-1 control-label">Cover baru</label>
										<div class="col-sm-11">
										<input type="file" id="cover" class="form-control" name="cover" data-toggle="tooltip" data-placement="bottom" title="pilih gambar untuk dijadikan cover!">
										</div>
									</div>
									<img src="img/jarak.png">
									<div class="form-group">
										<label class="col-sm-1 control-label"></label>
										<div class="col-sm-1">
										<button class="btn btn-success" type="submit" name="simpan"><span class="icon fa fa-save"></span> Simpan</button>
										</div>
										<div class="col-sm-1">
										<a href="edit_buku.php?id_buku=<?php echo $edit['id_buku'] ?>" type="button" class="btn btn-danger" style="color:#fff;"><span class="icon fa fa-repeat"></span> Kembali</a>
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