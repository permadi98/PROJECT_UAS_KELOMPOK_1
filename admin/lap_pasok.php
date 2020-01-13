<?php
include 'atap_lap.php';
?>

            <div class="container-fluid">
                <div class="side-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title col-xs-12">
									<br>
                                    <div class="title">Laporan Pemasokan Buku</div>
									<br>
                                    </div>
                                </div>
                                <div class="card-body">
									<center><legend><h2>Laporan Pemasokan Buku</h2></legend></center>
<form method="post" action="../laporan/lap_pasok_pdf.php" target='_blank'>
	<div class="table-responsive">
    <table class="table table-hover table-bordered" cellspacing="0" style="width:60%;" align="center">
		<tr>
			<td colspan='3'>
				<div class="radio3 radio-check radio-primary">
                    <input type="radio" id="semua" name="berdasar" value="Semua Data">
                    <label for="semua">
                    Semua Data
                    </label>
                </div>			
			</td>
		</tr>	
		<tr>
			<td>
				<div class="radio3 radio-check radio-primary"> 
					<input type="radio" id="tanggal" name="berdasar" value="Tanggal">
					<label for="tanggal"> Tanggal 
					</label> 
				</div> 
			</td>
			<td><input name="dari" type="text" id="tglcari" placeholder="Dari" size="7" maxlength="10" class="form-control" /></td>
			<td><input name="ke" type="text" id="tglcari2" class="form-control" placeholder="Ke" size="7" maxlength="10" /></td>
		</tr>	
		
		<tr height="30">
			<td colspan="3" align="center">
				<button type="submit" name="print" class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</button>
			</td>
		</tr>
	</table>
	</div>
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
