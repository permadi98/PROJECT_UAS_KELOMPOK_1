<?php
include_once '../koneksi.php';
session_start();

if (!isset($_SESSION["kasir"])) {
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
						<li class="dropdown" style="border-bottom:4px solid #9900FF;">
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
				
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#" style="background:#ffffff;">
                                <img src="../img/G1.png" style="height:63px;">
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                            
                            <li>
                                <a href="index.php">
                                    <span class="icon fa fa-thumbs-o-up"></span><span class="title">Halaman Kasir</span>
                                </a>
                            </li>
						
							<li>
                                <a href="buku.php">
                                    <span class="icon fa fa-book"></span><span class="title">Data Buku</span>
                                </a>
                            </li>
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-table">
                                    <span class="icon fa fa-file-pdf-o"></span><span class="title">Laporan</span>
                                </a>
                                <div id="dropdown-table" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="lap_buku.php">Laporan Data Buku</a>
                                            </li>
                                            <li><a href="lap_pasok.php">Laporan Pemasokan Buku</a>
                                            </li>
											<li><a href="lap_jual.php">Laporan Penjualan Buku</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
			
			