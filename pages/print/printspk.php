<?php
session_start()
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Print SPK</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mycss.css" rel="stylesheet" type="text/css" />	
	<link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	

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
							</span> 
						</a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        EA+
                    </div>
                </li>
                      <li>
						<?php	
							include "inc/inc.koneksi.php";
							$idinduk="2";	
							
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
                    <h2>Surat Perintah Kerja</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="?mod=home">Home</a>
                        </li>
                        <li>
                            <a href="#">SPK</a>
                        </li>
                        <li class="active">
                            <strong>Print SPK</strong>
                        </li>
                    </ol>
                </div>
   
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
					<div class="ibox-content print" style="border: 1px solid #000000;">
					<div class="row">
								<div class="col-xs-12" id="spk_area"></div>
							</div>
					<!--<p><b><i>No SPK : SPK.01.04.2017</i></b></p>
					<hr style="border: 1px solid #000000;">
							--><div class="row">
								<div class="col-xs-12" id="perusahaan_area"></div>
							</div>	
							<div class="row">
								<div class="col-xs-12">
									<div class="col-xs-1"></div>
									<div class="box-body col-sm-12">
										<div class="table-responsive" id="produk_area"></div>								
									</div>									
								</div>	
							</div>
							<div class="row">
								<div class="col-xs-12" id="ket_area"></div>
							</div>	
							
							<br>
							<br>
							<br>
						</div>
				<div class="ibox-content no-print">
				  <div class="row">						
						<div class="col-sm-12">
							<button class="btn btn-default pull-right" onClick="window.print();"><i class="fa fa-print"></i> Print</button>						
						</div>	
				</div>
				</div>						
						<br>
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
 
	<script src="js/printspk.js"></script>
	 
</body>

</html>
