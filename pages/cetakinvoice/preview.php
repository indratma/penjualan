<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ions | Invoice</title>
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
    <body class="skin-blue">
        <header class="header">
            <a href="index.html" class="logo">
                Indratma Trans
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
									<?php echo $_SESSION[namalengkap];?>
								<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $_SESSION[pathavatar];?>" class="img-circle" alt="User Image" />
                                    <p>									
										<?php echo $_SESSION[posisi];?>
                                        <small>Join since Mei 2014</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="?mod=exit" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $_SESSION[pathavatar];?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $_SESSION[namalengkap];?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
					
                    <ul class="sidebar-menu">
						<?php	
							include "inc/inc.koneksi.php";
							$idinduk="2";	
							
							//$del = "DELETE FROM lintasform WHERE userid='$_SESSION[namauser]'";
							//mysql_query($del);				
							
							$queryx="SELECT b.link,b.menu_class,b.menu_caption,a.id_induk,a.id_anak FROM aksesmenu a 
									LEFT JOIN menu_induk b ON b.id_induk=a.id_induk 
									WHERE a.username='$_SESSION[namauser]' GROUP BY a.id_induk ORDER BY a.id_induk";																		
							$sql_ = mysql_query($queryx);
							while($menu = mysql_fetch_array($sql_)){
								if($menu[id_induk]==$idinduk){
									if($menu[id_anak]>0){
										 echo "
										 <li class='treeview active'>";
									}else{
										echo "
										 <li class='active'>";
									}	 									 
								}else{	 
									if($menu[id_anak]>0){
										echo "
										 <li class='treeview'>";
									}else{
										echo "<li>";
									}	 			
								}
								
								echo "									
									<a href='$menu[link]'>
										<i class='$menu[menu_class]'></i><span> $menu[menu_caption]</span>";
										if($menu[id_anak]>0){
											echo "
												<i class='fa fa-angle-left pull-right'></i>";
										}
								echo "</a>";
								
								if($menu[id_anak]>0){
									echo "
										<ul class='treeview-menu'>";					
										
									$sqlx = mysql_query("SELECT b.link,b.menu_class,b.menu_caption FROM aksesmenu a LEFT JOIN menu_anak b 
														ON b.id_anak=a.id_anak WHERE a.id_induk=$menu[id_induk] AND a.username='$_SESSION[namauser]' ORDER BY a.id_anak");
									while($menu_a = mysql_fetch_array($sqlx)){
										echo "
											<li><a href='$menu_a[link]'><i class='$menu_a[menu_class]'></i> $menu_a[menu_caption]</a></li>";							
									}
									
									echo "</ul>";
								}
								echo " 									
								</li>";	
							}	
						?>						
						
                    </ul>
                </section>
            </aside>
			
			
			<aside class="right-side">
			
				<section class="content-header">
                    <h1>
                        Invoice
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-folder"></i>Order Trucking</a></li>
                        <li class="active">Cetak Invoice</li>
                    </ol>
                </section>	
		
				
						<!-- Main content -->
						<section class="invoice" style="
							padding:5px;">
						  <!-- title row -->
						  <div class="row">
							<div class="col-xs-12 page-header">
							  <h4>
								<i class="fa fa-globe"></i> Indratma Trans Nasional
								
							  </h4>
							  <h5>Jl. Raya Kedungmundu 18C-D</h5>
							  <h5>Telp.&nbsp;024-76747916</h5>
							</div>
							<!-- /.col -->
						  </div>
						  <center>
						  <div class="row"><strong><h3><u>INVOICE</u></h3></strong></div>	
							<div class="row">
							</center><br>
						  <!-- info row -->
						  <div class="row invoice-info">
							<div class="col-sm-5 invoice-col">
								<address>Kepada <br>
									<strong><span class="nama_perusahaan"></span></strong><br>
									<span id="alamat"></span>,&nbsp;<br><span id="kota"></span><br>
									Phone: <span id="notelp"></span>,&nbsp;<span id="nohp"></span><br>
									
								</address>
							</div>
							<!-- /.col -->
							<div class="col-sm-6 invoice-col pull-right">
								<table class="text-left">
									<tr>
										<td style="width:100px"><b>No Invoice</b></td>
										<td style="width:3px"><b>:</b>&nbsp;</td>
										<td style="width:150px" id="kodeinvoice"></td>
										
									</tr>
									<tr>
										<td style="width:100px"><b>Tgl Cetak</b></td>
										<td style="width:3px"><b>:</b>&nbsp;</td>
										<td style="width:150px" id="tglinvoice"></td>
										
									</tr>
									<tr>
										<td style="width:100px"><b>Tgl Muat</b></td>
										<td style="width:3px"><b>:</b>&nbsp;</td>
										<td style="width:150px" id="tglmuat"></td>
										
									</tr>
									
									
								</table>
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->

						  <!-- Table row -->
						  <div class="row">
							<div class="col-xs-12 table-responsive">
							  <table class="table table">
								<thead style="background-color:#f3f4f5">
								<tr style="background-color:#f3f4f5">
								  
								  <th>Muatan</th>
								  <th>Nopol</th>
								  <th>Dari</th>
								  <th>Tujuan</th> 
								  <th>
								  <?php 
									session_start();
									include "inc/fungsi_hdt.php";

									$username = $_SESSION[namauser];
									$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username' AND idtrx='prevp'";
									$sql 	= mysql_query($text);
									$tampil = mysql_fetch_array($sql);
									$kode 	= $tampil[kodetrx];
									
									$text1 	= "SELECT nosuratjalan AS suratjalan FROM suratjalan WHERE kodeorder='$kode'";
									$sql1 	= mysql_query($text1);	
									$jmlrec	= mysql_num_rows($sql1);
									if ($jmlrec > 0){
										echo "SJ";
									}
								  ?>
								  </th>
								  <th>Berat</th>
								  <th>Harga</th>
                                  <th class="text-center">Subtotal</th>
								 
								</tr>
								</thead>
								<tbody>
								<tr>
								  <td id="namabrg"></td>
								  <td id="armada"></td>
								  <td id="kotaasal"></td>
								  <td id="kotatujuan"></td>
								  <td>
								  <?php 
									if ($jmlrec > 0){
										while($rec = mysql_fetch_array($sql1)){				
										echo "$rec[suratjalan]<br>";
										}
									}
								  ?>
								  </td>
								  <td id="berat"></td> 
								  <td class="biayasewa"></td>
                                  <td id="subtot" class="text-right"></td>
								</tr>
								
								</tbody>
							  </table>
							  
							  
							</div>
							
							<!-- /.col -->
						  </div>
						  <div class="row">
							<div class="col-xs-12 table-responsive" id="tblitemtambahan">
							</div>
							
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
						
						<div class="row">
							<!-- accepted payments column -->
							<div class="col-xs-6">
								<strong>Catatan:</strong>
								<br><textarea class="form-control" rows="5" placeholder="" id="catatan">
                                </textarea>
							</div>
							<!-- /.col -->
							<div class="col-xs-6">
								<div class="table-responsive">
								<br>
								<table class="table">
									<tr>
										<th style="width:50%">Total:</th>
										<td id="grandtot" class="text-right"></td>
									</tr>
									<tr >
										<td colspan="2" id="terbilang"></td>
									</tr>
									<tr>
									<th></th>
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
							<div class="col-xs-6">
								<div class="table-responsive">
								<br>
								<table class="table">
								  <tr>
									<th height="79" style="width:50%">Hormat Kami,</th>
									<td ></td>
                                    <td ></td>
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
								<table>
								  <tr>
									<td >&nbsp;&nbsp;</td>
									<td class="pencetak"></td>
	                              </tr>
								</table>
								<table class="table">
								  <tr>
									<td ></td>
                                    <td ></td>
	                              </tr>
								</table>
								
							  </div>
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
                          
						  <!-- this row will not appear when printing -->
						  <div class="row no-print">
							<div class="col-xs-12">
							  <!--<a href="media.php?mod=print" target="_blank">-->
							  <button type="button" id="diprint" onClick="window.print();" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print
							  </button>
							  <button type="button" class="btn btn-primary" onClick="window.location='?mod=cetakinv'"><i class="fa fa-reply"></i>&nbsp;Back</button>
							</div>
						  </div>
						</section>
						
						<!-- /.content -->
			</aside>
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