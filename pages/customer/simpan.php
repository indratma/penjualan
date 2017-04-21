<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodecust	= $_POST[kodecust];
$nama		= strtoupper($_POST[nama]);
$prshn		= strtoupper($_POST[prshn]);
$alamat		= strtoupper($_POST[alamat]);
$kota		= strtoupper($_POST[kota]);
$telp		= $_POST[telp];
$hp			= $_POST[hp];
$ket		= $_POST[ket];
$username 	= $_SESSION[namauser];

if(empty($kodecust)){

	$text	= "SELECT MAX(RIGHT(kode_customer,4)) AS nourut FROM customer";
	$sql 	= mysql_query($text);
	$row	= mysql_num_rows($sql);
	if($row>0){
		$rec = mysql_fetch_array($sql);
		$nourut = $rec[nourut];
		$nourut	= $nourut+1;
		if($nourut>9999){
			 $nourut=1;
		}	 
		$kode	= "CS".sprintf("%04s",$nourut);	
	}else{
		$kode	= "CS0001";		
	}
	
	$input = "INSERT INTO customer(kode_customer,nama_customer,nama_perusahaan,alamat,kota,notelp,nohp,ket,userid,tglentry,onview ) 
				VALUES('$kode','$nama','$prshn','$alamat','$kota','$telp','$hp','$ket','$username',SYSDATE(),'1')";
	mysql_query($input);
	
	echo "<h4>Simpan data sukses</h4>";
	
}else{

	$input = "UPDATE customer SET nama_customer='$nama',nama_perusahaan='$prshn',alamat='$alamat',kota='$kota',notelp='$telp',nohp='$hp',ket='$ket',userid='$username',tglentry=SYSDATE()
			WHERE kode_customer='$kodecust'";
	mysql_query($input) or die(mysql_error());
	
	$input = "DELETE FROM lintasform WHERE userid='$username'";
	mysql_query($input);
	
	echo "<h4>Update Data Sukses</h4>";
}	

?>