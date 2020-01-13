<?php
include 'atap_keranjang.php';
?>

            <div class="container-fluid">
                <div class="side-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">

                                <div class="card-header">
                                    <div class="card-title col-xs-12">
									<br>
                                    <div class="title">Transaksi Penjualan</div>
									<br>
                                    </div>
									<div class="col-sm-10">
										<a href="buku.php" onclick="return alert('klik tombol jual untuk menambahkan buku kedalam keranjang..!!')" type="button" class="btn btn-primary col-sm-2"><span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-shopping-cart"></span> Tambah Buku</a>
										
									</div>
									<br>
                                </div>
                                <div class="card-body">
								<div class="table-responsive">
                                    <table class="table table-hover" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th><center>Judul Buku</th>
                                                <th><center>Harga</th>
                                                <th><center>Jumlah</th>
                                                <th style="width:150px;"><center>Sub Total</th>
                                                <th style="width:150px;"><center>Aksi</th>
                                            </tr>
                                        </thead>
								<?php
								$total = 0;
								if (isset($_SESSION['items'])) {
								foreach ($_SESSION['items'] as $key => $val) {
									$query = $DB_con->query("select * from buku where id_buku = '$key'");
									$data = $query->fetch(PDO::FETCH_ASSOC);

									$jumlah_harga = $data['harga_jual'] * $val;
									$total += $jumlah_harga;
									?>
                                        <tbody>
                                            <tr>
                                                <td width="" align="center"><?php echo $data['judul'] ?></td>
                                                <td width="" align="center">Rp.<?php echo number_format($data['harga_jual'],2,",",".");?></td>
                                                <td width="" align="center"><?php echo number_format($val); ?></td>
												<td width="" align="center">Rp.<?php echo number_format($jumlah_harga,2,",",".");?></td>
                                                <td width="" align="center">
												<a href="cart.php?act=plus&amp;id_buku=<?php echo $key; ?>&amp;ref=keranjang.php" type="button" class="btn btn-success" style="color:#fff; margin-bottom:5px;" title="Ubah"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
												<a href="cart.php?act=min&amp;id_buku=<?php echo $key; ?>&amp;ref=keranjang.php" type="button" class="btn btn-info" style="color:#fff; margin-bottom:5px;" title="Ubah"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
												<a href="cart.php?act=del&amp;id_buku=<?php echo $key; ?>&amp;ref=keranjang.php" onclick="return confirm('Anda yakin akan menghapus data buku ini?')" type="button" class="btn btn-danger" style="color:#fff; margin-bottom:5px;" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
												</td>
											</tr>
								<?php
									}
								}					
								?>
											<tr class="info" >
												<td align="center"><b>Total</b></td>
												<td colspan="2"></td>
												<td align="center">Rp.<?php echo number_format($total,2,",",".");?></td>
												<td></td>
											</tr>
											<form id="jual" name="jual" method="post" action="../laporan/struk.php" target='_blank'>
											<tr class="active" >
												<td align="center"><b>Bayar</b></td>
												<td colspan="2">
												<input type="hidden" name="total" id="total" value="<?php echo $total ?>" onfocus="startCalculate()" onblur="stopCalc()" disabled>
												</td>
												<td align="center">
												<input type="text" class="form-control" name="bayar" style="max-width:145px;" id="bayar" placeholder="bayar" onfocus="startCalculate()" onblur="stopCalc()" required>
												
												</td>
												<td></td>
											</tr>
											<tr class="info" >
												<td align="center"><b>Kembalian</b></td>
												<td colspan="2"></td>
												<td align="center">
												<input type="text" class="form-control" name="kembalian" style="max-width:145px;" id="kembalian" placeholder="kembalian" onfocus="startCalculate()" onblur="stopCalc()" disabled>
												
												</td>
												<td></td>
											</tr>
											<tr>
												<td align="center"></td>
												<td colspan="2"></td>
												<td align="center">
												<button class="btn btn-primary" style="width:150px;" type="submit" name="jual"><span class="icon fa fa-money"></span> Checkout</button>
												</td>
												<td align="center">
												<a href="cart.php?act=clear&amp;ref=keranjang.php" onclick="return confirm('Anda yakin akan menghapus semua buku dalam keranjang?')" type="button" class="btn btn-danger" style="color:#fff; width:150px;"><span class="icon fa fa-trash"></span> Hapus</a>
												</td>
											</tr>
									</form>
                                        </tbody>
                                    </table>
								</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
<script type="text/javascript">
function startCalculate(){
interval=setInterval("Calculate()",10);
}
function Calculate(){
var a=document.jual.total.value;
var b=document.jual.bayar.value;
var c=(b-a);
	if (!isNaN(c)){
	document.jual.kembalian.value=c;
	}
}
function stopCalc(){
clearInterval(interval);
}
</script>
		
<?php
include 'alas.php';
?>