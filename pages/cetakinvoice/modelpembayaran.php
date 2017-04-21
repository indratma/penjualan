<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ions | Pembayaran Customer</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="img/favicon.png" rel="shortcut icon" type="image/png" />
		
    </head>
    <body class="skin-blue">
        <header class="header">
            <a href="index.html" class="logo">
                Indratma Corp
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
							
							$del="DELETE FROM checkbox_temp WHERE userid='$_SESSION[namauser]'";																		
							mysql_query($del);							
							
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
														ON b.id_anak=a.id_anak WHERE a.id_induk=$menu[id_induk] 
														AND a.username='$_SESSION[namauser]' ORDER BY a.id_anak");
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
                       	Mode Pembayaran Customer
                        <small>Input Data</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-folder"></i>Order Trucking</a></li>
                        <li class="active">	Pembayaran Customer</li>
                    </ol>
                </section>				
                <section class="content">
					<div class="box box-solid"><br>
						<div class="box-header" >
							<h4 style="font-family: 'Kaushan Script', cursive;font-size:18px;color:#CCCCCC" class="box-title">
							&nbsp; Form Pembayaran Customer</h4>							
						</div><hr>						
							<div class="form-group"> 
									<label for="cbosistembyr" class="col-sm-2 control-label">Sistem Bayar</label>
									<div class="col-sm-2">	
										<select class="form-control" id="cbosistembyr">
											<option value='1' selected>Tunai</option>
											<option value='0'>Non Tunai</option>
										</select>
									</div>	
								</div>
								<div class="form-group">
									<label for="cbobank_tujuan" class="col-sm-2 control-label">Rekening Tujuan</label>
									<div class="col-sm-3">												
										<select id="cbobank_tujuan" name="cbobank_tujuan" class="form-control" disabled>
											<option value='' > - Nama Bank - </option>
										</select>
									</div>
									<div class="col-sm-3">
										<input type="text" id="txtnorek_tujuan" class="form-control" placeholder="No Rekening" disabled/>
									</div>
									<div class="col-sm-2">	
										<span class="help-block"><a href="#" id="bank_add" style="display:none">| Or Add New Bank</a></span>
									</div>
								</div>
								<div class="form-group">
									<label for="txtownrek" class="col-sm-2 control-label">Pemilik Rekening</label>
									<div class="col-sm-4">
										<input type="text" id="txtownrek" class="form-control" disabled/>
									</div>
								</div>
										  	
							</form>	
						</div>
						<div class="row">
							<div class="col-xs-12 text-center">
								<label id="lblwarning_save" style="color:#FF0000"></label>
							</div>
						</div><br>
						<div class="box-footer text-right" >	
							<button type="button" class="btn btn-danger" onClick="window.location='?mod=cetakinv'">
								<i class="fa  fa-dot-circle-o"></i>&nbsp; Tutup</button>
							<button type="button" class="btn btn-success" id="btnconfirm">
								<i class="fa fa-save (alias)"></i>&nbsp; Simpan
							</button>							
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
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
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
		<script src="js/newmdbyr.js" type="text/javascript"></script>	
		<script src="js/ribuan.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
		<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>       	
    </body>
</html>