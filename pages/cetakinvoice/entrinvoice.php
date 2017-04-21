<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ions | Invoice</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<link href="css/editable.css" rel="stylesheet" type="text/css" />
		<link href="js/assets/css/styles.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="css/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
        <link href="css/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
        <link href="css/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
		<link href="assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
		<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
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
                                <!-- User image -->
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
							session_start();
							include "inc/inc.koneksi.php";
							include "inc/fungsi_hdt.php";
							$idinduk = "2";			
							
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
														ON b.id_anak=a.id_anak WHERE a.id_induk=$menu[id_induk] AND a.username='$_SESSION[namauser]' 
														ORDER BY a.id_anak");
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
                        <small>Input Data</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-folder"></i>Order Trucking</a></li>
                        <li class="active">Invoice</li>
                    </ol>
                </section>				
                <section class="content">
					<div class="box box-solid"><br>
						<div class="box-header" >
							<h4 style="font-family: 'Kaushan Script', cursive;font-size:18px;color:#CCCCCC" class="box-title">&nbsp; Form Invoice</h4>							
						</div><hr>
						
						<div class="box-body">
							<form class="form-horizontal">	
								<div class="form-group">
									<label for="cboarmada" class="col-sm-3 control-label">Customer</label>
									<div class="col-sm-5">
										<input type="text" id="txtcustomer" class="form-control" disabled/>
										<input type="hidden" id="txtkdcustomer" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label for="cbocustomer" class="col-sm-3 control-label">Alamat</label>
									<div class="col-sm-5">
										<textarea rows='3' class="form-control" id='txtalamatcust' disabled></textarea>	
									</div>
								</div>		
								<div class="form-group">
									<label for="cboarmada" class="col-sm-3 control-label">Armada</label>
									<div class="col-sm-5">
										<input type="text" id="txtarmada" class="form-control" disabled/>
										<input type="hidden" id="txtkdarmada" class="form-control"/>
										<input type="hidden" id="txtkodeorder" class="form-control"/>
										<input type="text" id="txtnoinvoice" class="form-control" readonly/>
									</div>
								</div>															
								<div class="form-group">
									<label for="cbokotaasal" class="col-sm-3 control-label">Tujuan</label>
									<div class="col-sm-5">
										<input type="text" id="txttujuan" class="form-control" disabled/>
									</div>
								</div>
								<div class="form-group">
									<label for="cbokotatujuan" class="col-sm-3 control-label">Tgl Muat</label>
									<div class="col-sm-2">
										<input type="text" id="txttglmuat" class="form-control" disabled/>
									</div>
									<label for="cbokotatujuan" class="col-sm-1 control-label">Estimasi</label>
									<div class="col-sm-2">
										<input type="text" id="txttglestimasi" class="form-control" disabled/>
									</div>
								</div>
								<div class="form-group">	
									<label for="txttglbongkar" class="col-sm-3 control-label">Tgl Bongkar</label>	
									<div class="col-sm-2">	
										<input type="text" id="txttglbongkar" class="form-control" disabled/>
									</div>									
								</div>	
                                <div class="form-group">
									<label for="txtjml" class="col-sm-3 control-label">Berat</label>
									<div class="col-sm-2">
										<input type="text" class="form-control text-center" id="txtjml" 
										onKeyDown="return numbersonly(this, event);" onKeyUp="javascript:tandaPemisahTitik(this);" placeholder="0" />
									</div>
									<div class="col-sm-2">
										<select id="cbosatuan" name="cbosatuan" class="form-control" disabled>
											<option value='1' >Kg</option>
											<option value='2' selected>Ton</option>
										</select>										
									</div>						
								</div>
								<div class="form-group">
									<label for="txtbiaya" class="col-sm-3 control-label">Biaya Kirim</label>
									<div class="col-sm-2">
										<input type="text" class="form-control text-center" id="txtbiaya" 
										onKeyDown="return numbersonly(this, event);" onKeyUp="javascript:tandaPemisahTitik(this);" placeholder="0" />
									</div>
									<div class="col-sm-2">
										<select id="cbopersatuan" class="form-control" disabled>
											<option value='1' >Per Kg</option>
											<option value='2' selected>Per Kirim</option>
										</select>										
									</div>						
								</div>
                                <div class="form-group">
									<label for="cbobank_tujuan" class="col-sm-3 control-label">Rekening Tujuan</label>
									<div class="col-sm-2">												
										<select id="cbobank_tujuan" name="cbobank_tujuan" class="form-control" >
											<option value='' > - Nama Bank - </option>
										</select>
									</div>
									<div class="col-sm-3">	
										<span class="help-block"><a href="#" id="bank_add">| Or Add New Bank</a></span>
									</div>
								</div>
								<div class="form-group">	
									<label for="txtnosj" class="col-sm-3 control-label">No Surat Jalan</label>	
									<div class="col-sm-3">	
                                        <input type="text" id="txtsuratjalan" class="form-control" />
									</div>	
									<div class="col-sm-2">
										<button type="button" id="btn_addsj" class="btn btn-default"><i class="fa fa-plus"></i></button>
									</div>
								</div>
								<div class="form-group">
									<label for="txtnosj" class="col-sm-3 control-label"></label>
									<div class="col-sm-4">
										<div class="table-responsive" id="tblsuratjalan"></div>
									</div>
								</div>
								<div class="form-group">	
									<label for="txtnosj" class="col-sm-3 control-label">Item Tambahan</label>	
									<div class="col-sm-3">	
                                        <input type="text" id="txtitemtambahan" class="form-control" />
									</div>	
									<div class="col-sm-2">	
                                        <input type="text" id="rpitemtambahan" class="form-control" placeholder="Nominal (Rp)" />
									</div>	
									<div class="col-sm-2">
										<button type="button" id="btn_additem" class="btn btn-default"><i class="fa fa-plus"></i></button>
									</div>
								</div>
								<div class="form-group">
									<label for="txtitemtambahan" class="col-sm-3 control-label"></label>
									<div class="col-sm-5">
										<div class="table-responsive" id="tblitemtambahan"></div>
									</div>
								</div>
								<div class="form-group">
									<label for="cbopencetak" class="col-sm-3 control-label">Atas Nama Pencetak</label>
									<div class="col-sm-3">												
										<select id="cbopencetak" name="cbopencetak" class="form-control" >
											<option value='' > - Silahkan Pilih - </option>
										</select>
									</div>
									
								</div>
								<br>
							</form>	
						</div>						
						<br>						
						<div class="row">
							<div class="col-xs-12 text-center">
								<label id="warningx" style="color:#FF0000"></label>
							</div>
						</div>							
						<div class="box-footer text-right" >	
							<button type="button" class="btn btn-default" onClick="window.location='?mod=cetakinv'">
								<i class="fa fa-dot-circle-o"></i>&nbsp; Lihat Daftar Invoice</button>
							<button type="button" id="btnconfirm" class="btn btn-success">
								<i class="fa fa-save (alias)"></i>&nbsp; Simpan</button>							
						</div>
					</div>	
                </section>
            </aside>
        </div>  
		<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Konfirmasi</h4>
					</div>
					<div class="modal-body text-center">
						<h3>Yakin akan disimpan ?</h3>											
					</div>
					<div class="modal-footer clearfix" id="btnexec">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
						<button type="button" class="btn btn-primary pull-left" id="btnsave"><i class="fa fa-check"></i> Ya</button>
					</div>
					<div class="overlay" id="overlayx"></div>
					<div class="loading-img" id="loading-imgx"></div>						
                </div>
            </div>
        </div>
        <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Informasi</h4>
					</div>
					<div class="modal-body text-center" id="infone"></div>
					<div class="modal-footer text-center">
						<button type="button" class="btn btn-primary" data-dismiss="modal" id="btnok"><i class="fa fa-check"></i> OK</button>
					</div>					
                </div>
            </div>
        </div> 
        <div class="modal fade" id="regnewbank-modal" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Input Bank Baru</h4>
			</div>
			<div class="modal-body">
				<div class="form-group col-sm-12">
					<input type="text" class="form-control text-center" id="txtbank" placeholder="Nama Bank"/>
				</div>
                <div class="form-group col-sm-12">
					<input type="text" class="form-control text-center" id="txtnorek" placeholder="No. Rekening"/>
				</div>
                 <div class="form-group col-sm-12">
					<input type="text" class="form-control text-center" id="txtownrek" placeholder="Atas Nama"/>
				</div>
				<div class="form-group">
					
				</div>
				<div class="form-group text-center" style="color:#FF0033;display: none;" id="warningreg">Tes
				</div>
			</div>
		<div class="modal-footer clearfix">
			<button type="button" class="btn btn-primary  pull-left" id="btnadd" title="Tambah Nama Bank"><i class="fa fa-plus"></i> Tambah</button>
			<button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
			
		</div>	
       </div>
     </div>
	</div>   
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
   		<script src="js/jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
		<script src="js/newinvoice.js" type="text/javascript"></script>	
		<script src="js/ribuan.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="js/assets/js/jquery.filedrop.js"></script>
        <script src="js/assets/js/script.js"></script>
        <script src="js/AdminLTE/app.js" type="text/javascript"></script> 
		<script src="assets/global/plugins/select2/select2.min.js" type="text/javascript" ></script>
		<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
		<script src="js/components-dropdowns.js" type="text/javascript" ></script>
		<script>
				jQuery(document).ready(function() { 
				   Metronic.init(); 
				   ComponentsDropdowns.init();
				});   
		</script>  
    	
    </body>
</html>