<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";

$kodeorder		= $_POST[kodeorder];
$kode			= $_POST[kode];
$username 		= $_SESSION[namauser];


if($ada==0){
		$text	= "SELECT MAX(LEFT(kodeorder,3)) AS nourut FROM spm";
		$sql	= mysql_query($text);
		$row	= mysql_num_rows($sql);
		if($row>0){
			$rec = mysql_fetch_array($sql);
			$nourut = $rec[nourut]+1;
			if($nourut>999){
				$nourut=1;
			}	 		
		}else{
			$nourut=1;	
		}
	
	$text	= "SELECT DATE_FORMAT(SYSDATE(),'%m%Y') AS blnskg FROM DUAL";
	$sql	= mysql_query($text);
	$rec 	= mysql_fetch_array($sql);
	$blnskg = $rec[blnskg];

	$kode 		= sprintf("%03s",$nourut).'/SPM/'.$blnskg;
			
	$input = "INSERT INTO spm(
							kodespm,
							kodeorder,
							tglentry,
							userid
							)
				VALUES('$kode', 
						'$kodeorder',
						SYSDATE(),
						'$username')";
	mysql_query($input);
//var_dump($input);die;
	echo '<table class="table table-bordered">';
	echo '<tr>';
	echo '<td>'.$kode.'</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>'.$kodeorder.'</td>';
	echo '</tr>';
	echo '</table>';
	//echo "<h4>Simpan Data Sukses,</p> No Purchase Order Anda : <h4>".$kodeorder."</h4>";
	
}else{
	
	echo "gagal";
}	


?>