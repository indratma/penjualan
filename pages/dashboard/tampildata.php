<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
 
$kode		= $_GET[kode]; 
$username 	= $_SESSION[namauser];
$kdprshn 	= $_SESSION[kodeprshn];

echo "
	<div class='row'>
		<div class='col-lg-3 col-xs-6'>
			<a href='#' class='small-box bg-aqua'>
				<div class='inner'>
					<label></label>
					<h3>						
						20						
					</h3>
					<p>						
						New Order
					</p>
				</div>
				<div class='icon'>
					<i class='ion ion-pie-graph'></i>
				</div>
				<div class='small-box-footer'>
					More info <i class='fa fa-arrow-circle-right'></i>
				</div>
			</a>
		</div>
		<div class='col-lg-3 col-xs-6'>
			<a href='#' class='small-box bg-blue'>
				<div class='inner'>
					<label></label>
					<h3>
						10
					</h3>
					<p>
						available
					</p>
				</div>
				<div class='icon'>
					<i class='ion ion-pie-graph'></i>
				</div>
				<div class='small-box-footer'>
					More info <i class='fa fa-arrow-circle-right'></i>
				</div>
			</a>
		</div>"; 
	
?>	