<?php
include 'atap.php';
?>
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
							
							<li class="active">
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
			
			