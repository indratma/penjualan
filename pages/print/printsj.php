<?php
session_start()
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Print Surat Jalan</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
	<link href="css/mycss.css" rel="stylesheet" type="text/css" />	
	<link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	
<html>
</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
					<span>
					<img src="<?php echo $_SESSION[pathavatar];?>" class="img-circle" alt="image" height="50" />       
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
								<span class="block m-t-xs"> <strong class="font-bold">
									<?php 
										echo ucwords ($_SESSION['namalengkap']);	
									?>
									</strong>
								</span> 
								<span class="text-muted text-xs block">
									<?php 
										echo ucwords ($_SESSION['leveluser']);
									?>
								<b class="caret"></b>
								</span> 
							</span> <?php



?>

				
				</a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                      <li>
						<?php	
							include "inc/inc.koneksi.php";
							$idinduk="3";	
							
							$del = "DELETE FROM lintasform WHERE userid='$_SESSION[namauser]'";
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
										echo "<li class=''>";
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
										<ul class='nav nav-second-level'>";					
										
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
                </li>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom no-print">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header no-print">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to E-Adminsistration</span>
                </li>
                <li>
                    <a href="?mod=exit">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading no-print">
                <div class="col-lg-12 no-print">
                    <h2>Surat Jalan</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="?mod=home">Home</a>
                        </li>
                        <li>
                            <a href="?mod=daftarkirim">Pengiriman</a>
                        </li>
                        <li class="active">
                            <strong>Print Surat Jalan</strong>
                        </li>
                    </ol>
                </div>
   
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
					<div class="ibox-content">
							<div class="row">
							<div class="col-sm-5">
								<address>
									<strong><h3><i class='fa fa-globe'></i>&nbsp;<span id="pabrik"></h3></span></strong>
									<span id="alamat"></span><br>
									Email&nbsp;:&nbsp;<span id="email"></span>&nbsp;&nbsp; Website&nbsp;:&nbsp;<span id="web"></span>
								</address>
							</div>
							<!-- /.col -->
							<div class="col-sm-4 pull-right">
								<b><address class="text-left">Kepada&nbsp; Yth.</b><br>
									<span id="customer" ></span>&nbsp;<br><span id="tujuan"></span>
								</address>
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
						<div class="row">
							<div class='col-xs-12 text-center'>
							<h3><b><u>
							SURAT PENGANTAR BARANG
							</u></b></h3>
						NOMOR&nbsp;:&nbsp;<span id="kodekirim"></span><br><br><br> 	
						</div>
						</div>
						<div class="row">
							<div class="col-xs-12 text-left">
							<p>Dengan ini kami kirim barang yang tersebut dibawah ini dengan&nbsp;:</p>
						</span>Kendaraan&nbsp;:&nbsp;<span id="kendaraan"></span></span>&nbsp;&nbsp;&nbsp;Nomor&nbsp;Polisi&nbsp;:&nbsp;<span id="nopol"></span>
						</div>
						</div><br>
						  <!-- Table row -->
						  <div class="row">
							<div class="col-xs-12 table-responsive">
							  <table class="table table-bordered" height="200">
								<thead style="background-color:#f3f4f5">
								<tr style="background-color:#f3f4f5">
								  
								  <th class="text-center" width="100">Nomor</th>
								  <th class="text-center">Nama Barang</th>
								  <th class="text-center">Jumlah</th>
								  <th class="text-center">Keterangan</th> 
								  
								</tr>
								</thead>
								<tbody>
								<tr>
								  <td class="text-center">1</td>
								  <td class="text-center" id="barang"></td>
								  <td class="text-center" id="jml"></td>
								  <td class="text-center" id="ket"></td>
								</tr>
								
								</tbody>
							  </table>
							  
							  
							</div>
							
							<!-- /.col -->
						  </div>
						  <div class="row">
						  <div class="col-xs-6 pull-right">
							<hr style="width:50%; border: 1px dashed ;">
							</div>
							
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
						
						
						  <!-- /.row -->
						  <div class="row">
							<!-- accepted payments column -->
							<div class="col-xs-6">
								<div class="table-responsive">
								<br>
								<table class="table">
								  <tr>
									<th height="79" style="width:50%" class="text-right">Penerima,</th>
									<td ></td>
                                  
	                              </tr>
								</table>
								<hr style="width:40%; border: 1px solid #000000;" >
							  </div>
							</div>
							<!-- /.col -->
							<div class="col-xs-6">
								<div class="table-responsive">
								<br>
								<table class="table">
								  <tr>
									<th height="79" style="width:50%" class="text-right">Pengirim,</th>
									<td ></td>
                                  
	                              </tr>
								</table>
								<hr style="width:40%; border: 1px solid #000000;" >
							  </div>
							</div>
							<!-- /.col -->
						  </div>
				<div class="ibox-content no-print">
				  <div class="row">						
						<div class="col-sm-12">
							<button class="btn btn-default pull-right" onClick="window.print();"><i class="fa fa-print"></i> Print</button>						
						</div>	
				</div>
				</div>						
						<!--<div class="ibox-title" align="right">
						<button type="button"  onClick="window.print();" class="btn btn-success"><i class="fa fa-print"></i> Print
							  </button>
						</div>--->
                        </div>
                    </div>
                </div>
		</div>
        <div class="footer no-print">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Indrarma Coorporation &copy; 2017
            </div>
        </div>

        </div>
        </div>


     <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	
    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script> 
    <!-- Select2 -->
   <script src="js/plugins/select2/select2.full.min.js"></script>
   	<!-- javascript khusus -->
	<script src="js/printsj.js"></script>
	 
</body>

</html>
