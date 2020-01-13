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
			$id_kasir = $_GET['id_kasir'];
			$pass = $_POST['password'];
			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];
			$cek = $DB_con->prepare("SELECT * FROM kasir WHERE id_kasir='$id_kasir' AND password='$pass'");
			$cek->execute();
			$jmldata = $cek->rowCount();
			if($jmldata == 0){
					echo '<div class="alert alert-danger fresh-color alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password salah, masukan kembali password lama dengan benar..!!</div>';
			}else{
			if($password1 == $password2){
				$password = $password1;	
				$update = $DB_con->prepare("UPDATE kasir SET password='$password' WHERE id_kasir='$id_kasir'");
				if($update->execute()){
				echo"<script>alert('data berhasil dirubah, silahkan masuk kembali..!!');
				document.location.href='../logout.php'; </script>\n";
				} else{
				echo '<div class="alert alert-danger fresh-color alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password gagal dirubah..!!</div>';
				}
			}else{
						echo '<div class="alert alert-danger fresh-color alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pasword tidak sama, ulangi password dengan benar..!!</div>';
				}
			}
		}
?>

								<div class="card-header">
                                    <div class="card-title">
									<br>
                                    <div class="title">&nbsp;Ganti Password</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4><span class="icon fa fa-edit"></span> <span class="icon fa fa-lock"></span><span class="title">  ganti password kasir dengan id : <?php echo $edit['id_kasir'] ?> dan username : <?php echo $edit['nama'] ?></span></h4>
									<hr>
									<form method="post" enctype="multipart/form-data">
									<table class="table table-hover" style="width:60%;" align="center">
									
									<tr>
										<td><label for="pass" class="control-label">Password Lama</label></td>
										<td><div class="col-sm-12">
										<input type="password" class="form-control" style="min-width:145px" name="password" id="pass" placeholder="password lama" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="password1" class="control-label">Password Baru</label></td>
										<td><div class="col-sm-12">
										<input type="password" class="form-control" name="password1" id="password1" placeholder="password baru" required>
										</div></td>
									</tr>
									<tr>
										<td><label for="password2" class="control-label">Ulangi Password</label></td>
										<td><div class="col-sm-12">
										<input type="password" class="form-control" name="password2" id="password2" placeholder="ulangi password" required>
										</div></td>
									</tr>
									<tr>
										<td></td>
										<td><div class="col-sm-12"><button class="btn btn-success" type="submit" name="edit" style="width:93px;"><span class="icon fa fa-refresh"></span> Ganti</button>
										
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
		</div>
<?php
include 'alas.php';
?>