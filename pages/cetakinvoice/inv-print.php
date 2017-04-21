<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ions | Karyawan</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />	
		<link href="css/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
        <link href="css/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
        <link href="css/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">	
		<link href="img/favicon.png" rel="shortcut icon" type="image/png" />
    </head>
    <body onLoad="window.print();">
		<div class="wrapper">
		<section class="invoice">
						  <!-- title row -->
						  <div class="row">
							<div class="col-xs-12">
							  <h2 class="page-header">
								<i class="fa fa-globe"></i> Indratma Trans Nasional
								
							  </h2>
							</div>
							<!-- /.col -->
						  </div>
						  
						  <center>
						  <div class="row"><strong><h3><u>INVOICE</u></h3></strong></div>	
							<div class="row">
							</center><br>
						  
						  <div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
								<address>
									<strong><span class="nama_perusahaan"></span></strong><br>
									<span id="alamat"></span>,&nbsp;<span id="kota"></span><br>
									Phone: <span id="notelp"></span>,&nbsp;<span id="nohp"></span><br>
									
								</address>
							</div>
							<!-- /.col -->
							<div class="col-sm-4 invoice-col pull-right">
							  <table class="text-left">
								<tr>
									<td style="width:150px"><b>Kode Invoice</b></td>
									<td style="width:3px">&nbsp;<b>:</b>&nbsp;</td>
									<td style="width:150px" id="kodeinvoice"></td>
									
								</tr>
								<tr>
									<td style="width:150px"><b>Nama Marketing</b></td>
									<td style="width:3px">&nbsp;<b>:</b>&nbsp;</td>
									<td style="width:150px" id="marketing"></td>
									
								</tr>
								<tr>
									<td style="width:150px"><b>Tanggal Order</b></td>
									<td style="width:3px">&nbsp;<b>:</b>&nbsp;</td>
									<td style="width:150px" id="tglorder"></td>
									
								</tr>
							</table>
							  </div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->

						  <!-- Table row -->
						  <div class="row">
							<div class="col-xs-12 table-responsive">
							  <table class="table table-striped">
								<thead>
								<tr style="background-color:#f3f4f5">
								  <th>Nama Barang</th>
								  <th>Nopol</th>
								  <th>Customer</th>
								  <th>Kota Asal</th>
								  <th>Kota Tujuan</th>
								  <th>Tgl Muat</th>
								  <th>Tgl Bongkar</th>
								  <th>Berat</th>
								  <th>Biaya Sewa</th>
								</tr>
								</thead>
								<tbody>
								<tr>
								  
								  <td id="namabrg"></td>
								  <td id="armada"></td>
								  <td id="nama_perusahaan"></td>
								  <td id="kotaasal"></td>
								  <td id="kotatujuan"></td>
								  <td id="tglmuat"></td>
								  <td id="tglsampai"></td>
								  <td id="berat"></td>
								  <td class="biayasewa"></td>
								</tr>
								<tr>
								  
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								</tr>
								<tr>
								 
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								</tr>
								<tr>
								  
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								</tr>
								<tr>
								  
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								  <td></td>
								</tr>
								</tbody>
							  </table>
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->

						<div class="row">
							<!-- accepted payments column -->
							<div class="col-xs-6" id="txtcatan" >
							<strong>Catatan:</strong>
								<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
								<br>
								<br>
								<br>
                                <br>
								<br>
								<br>
                                <br>
								<br>
								<br>
							  </p>
							</div>
							<!-- /.col -->
							<div class="col-xs-6">
								<div class="table-responsive">
								<table class="table">
								  <tr>
									<th>Total:</th>
									<td class="biayasewa"></td>
								  </tr>
                                </table>
							  </div>
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
						<!-- /.row -->
						  <div class="row">
							<!-- accepted payments column -->
							<div class="col-xs-6">
							</div>
							<!-- /.col -->
							<div class="col-xs-6">
								<div class="table-responsive">
								<br>
								<table class="table">
								  <tr>
									<th height="79" style="width:50%">Yang bertanggung jawab:</th>
									<td ></td>
                                    <td></td>
	                              </tr>
								</table>
							  </div>
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
                          
                          <div class="row">
							<!-- accepted payments column -->
							<div class="col-xs-6">
							</div>
							<!-- /.col -->
							<div class="col-xs-3">
								<div class="table-responsive">
								<br>
								<table class="table">
								  <tr>
									<th style="width:50%"></th>
									<td ></td>
                                    <td></td>
	                              </tr>
								</table>
							  </div>
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
			</section>	
	
		<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Pengiriman Barang Detail</h4>
					</div>					
					<div class="modal-body">
						<div class="table-responsive" id="infone"></div>
					</div>
					<div class="modal-footer text-right">
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
					</div>		
					<div class="overlay" id="overlayx"></div>
					<div class="loading-img" id="loading-imgx"></div>	
                </div>
            </div>
        </div>
	
		</div>
		
		<script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>			
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
		<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="js/print.js" type="text/javascript"></script>
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
		
	</body>
</html>