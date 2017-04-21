<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username = $_SESSION[namauser];
$kode  = $_POST['kode'];

$data['info'] = '<h4>Hapus Data Customer gagal.</h4>';

$text	= "UPDATE customer SET onview=0,userid='$username',tglentry=SYSDATE() WHERE kode_customer='$kode'";
mysql_query($text);

$text	= "SELECT kode_customer FROM customer WHERE kode_customer='$kode' AND onview=1";
$sql 	= mysql_query($text);
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec==0){
	$data['info'] = '<h4>Hapus Data Customer sukses.</h4>';
}	
echo json_encode($data);
	
?>