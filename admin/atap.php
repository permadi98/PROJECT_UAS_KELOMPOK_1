<?php
include_once '../koneksi.php';
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: ../index.php");
} elseif (!isset($_SESSION)) {
        session_start();
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Admin Toko Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="stylesheet" type="text/css" href="../lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="../lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="../lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../lib/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/themes/permadi.css">
	<link type="text/css" href="../lib/datepicker/css/jquery-ui-1.8.13.custom.css" rel="Stylesheet" />
    <link rel="stylesheet" type="text/css" href="../loader/loader.css">	
</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
				
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
						<?php
								$jumlah = 0;
								if (isset($_SESSION['items'])) {
								foreach ($_SESSION['items'] as $key => $val) {
								$jumlah += $val;
								}
								}
						?>
						<li class="dropdown">
                            <a href="keranjang.php"><span class="glyphicon glyphicon-shopping-cart"></span> Keranjang  <span class="badge" style="background:#9900FF;"><?php echo $jumlah ?></span></a>
                            
                        </li>
                        <?php
						$query = $DB_con->query("SELECT * FROM kasir WHERE username='$_SESSION[username]' AND password='$_SESSION[password]'");
						$kasir  = $query->fetch(PDO::FETCH_ASSOC);
						?>
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user icon"> </i> <?php echo $kasir['nama'] ?><span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                    <img src="<?php echo $kasir['gambar'] ?>" class="profile-img">
                                </li>
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username"> <?php echo $kasir['nama'] ?></h4>
                                        <p> <?php echo $kasir['telepon'] ?></p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <a href="edit_kasir.php?id_kasir=<?php echo $kasir['id_kasir'] ?>" type="button" class="btn btn-primary"><i class="fa fa-user"></i> Profil</a>
                                            <a href="../logout.php" type="button" class="btn btn-primary"><i class="fa fa-sign-out"></i> Keluar</a>
                                        </div>
                                    </div>
                                </li>
						
                            </ul>
                        </li>
						
                    </ul>
                </div>
				
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>