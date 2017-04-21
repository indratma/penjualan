<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$barang		= $_POST[kdbarang];
$username 	= $_SESSION[namauser];

$text	=	"SELECT
				kode_barang,
				nama_barang,
				mesh
			 FROM
				barang
			 WHERE
				kode_barang = '$barang'";
$sql 	= mysql_query($text) or die(mysql_error());
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		$data['mesh']	= $r[mesh];
		echo json_encode($data);
	}		
}else{
		$data['mesh']	= $r[''];
		echo json_encode($data);	
}

?>