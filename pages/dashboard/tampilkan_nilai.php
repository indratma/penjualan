<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
 
$kode		= $_GET[kode]; 
$username 	= $_SESSION[namauser];

$text 	= "SELECT signas,nik FROM userapp WHERE username='$username'";					
$sql 	= mysql_query($text);	
$rec 	= mysql_fetch_array($sql);
$approveby 	= $rec[signas];
$nik	 	= $rec[nik];

if($approveby!='411'){

	$jml_toapprove=0;	
	$text 	= "SELECT kodeproses,idproc FROM alurprocurement WHERE approveby='$approveby'";					
	$s 		= mysql_query($text);	
	while($rs = mysql_fetch_array($s)){			
		$text 	= "SELECT * FROM approval WHERE COALESCE(result,'')='' AND idproc='$rs[idproc]' AND kodeproses='$rs[kodeproses]'";					
		$sq 	= mysql_query($text);	
		$jmlrec	= mysql_num_rows($sq);		
		$jml_toapprove = $jml_toapprove + $jmlrec;
	}		
	
}else{

	$jml_toapprove=0;
	$text 	= "SELECT * FROM approval WHERE COALESCE(result,'')=''";					
	$sq 	= mysql_query($text);	
	$jmlrec	= mysql_num_rows($sq);		
	$jml_toapprove = $jml_toapprove + $jmlrec;
}

$jml_approved=0;
$jml_pending=0;
$jml_decline=0;

$text 	= "SELECT * FROM approval WHERE result=1 AND userid='$username'";
$sq 	= mysql_query($text);	
$jmlrec	= mysql_num_rows($sq);
$jml_approved = $jml_approved + $jmlrec;

$text 	= "SELECT * FROM approval WHERE result=3 AND userid='$username' GROUP BY kodepermintaan";					
$sq 	= mysql_query($text);	
$jmlrec	= mysql_num_rows($sq);
$jml_pending = $jml_pending + $jmlrec;

$text 	= "SELECT * FROM approval WHERE result=2 AND userid='$username' GROUP BY kodepermintaan";					
$sq 	= mysql_query($text);	
$jmlrec	= mysql_num_rows($sq);
$jml_decline = $jml_decline + $jmlrec;

echo "
	<div class='row'>
		<div class='col-lg-3 col-xs-6'>
			<div class='small-box bg-aqua'>
				<div class='inner'>
					<h3>
						$jml_toapprove
					</h3>
					<p>
						To Approve
					</p>
				</div>
				<div class='icon'>
					<i class='ion ion-bag'></i>
				</div>
				<a href='?mod=toap' class='small-box-footer'>
					More info <i class='fa fa-arrow-circle-right'></i>
				</a>
			</div>
		</div>
		<div class='col-lg-3 col-xs-6'>
			<div class='small-box bg-green'>
				<div class='inner'>
					<h3>
						$jml_approved
					</h3>
					<p>
						Approved
					</p>
				</div>
				<div class='icon'>
					<i class='ion ion-pie-graph'></i>
				</div>
				<a href='?mod=appr' class='small-box-footer'>
					More info <i class='fa fa-arrow-circle-right'></i>
				</a>
			</div>
		</div>
		<div class='col-lg-3 col-xs-6'>
			<div class='small-box bg-yellow'>
				<div class='inner'>
					<h3>
						$jml_pending
					</h3>
					<p>
						Pending
					</p>
				</div>
				<div class='icon'>
					<i class='ion ion-pie-graph'></i>
				</div>
				<a href='?mod=pend' class='small-box-footer'>
					More info <i class='fa fa-arrow-circle-right'></i>
				</a>
			</div>
		</div>
		<div class='col-lg-3 col-xs-6'>
			<div class='small-box bg-red'>
				<div class='inner'>
					<h3>
						$jml_decline
					</h3>
					<p>
						Decline
					</p>
				</div>
				<div class='icon'>
					<i class='ion ion-pie-graph'></i>
				</div>
				<a href='?mod=decl' class='small-box-footer'>
				More info <i class='fa fa-arrow-circle-right'></i>
				</a>
			</div>
		</div>
	</div>"; 
	
?>	