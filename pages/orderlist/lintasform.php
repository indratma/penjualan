<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kode		= $_POST[kode];
$username 	= $_SESSION[namauser];

$result = 0;

$idtrx ='neworder';

$text	= "SELECT
			a.kodeorder,
			DATE_FORMAT(a.tglorder, '%d/%m/%Y') AS tglorder,
			c.nama_barang AS barang,
			a.jml as jumlah,
			b.nama_customer AS customer,
			CONCAT(b.alamat, ' , ', b.kota) AS  alamat
		FROM
			orderproduk a
		LEFT JOIN customer b ON b.kode_customer = a.kode_customer
		LEFT JOIN barang c ON c.kode_barang = a.kode_barang
		WHERE a.kodeorder='$kode' ";
			
$sql 	= mysql_query($text);
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec==1){
	$r=mysql_fetch_array($sql);
	
	$del ="DELETE FROM combobox WHERE userid='$username'";
	mysql_query($del);
	
	$ins ="INSERT INTO combobox(idcombo,val,caption,selected,userid) 
			VALUES('cbocustomer','$r[customer]','$r[customer]',1,'$username'),
					('cbobarang','$r[barang]','$r[barang]',1,'$username')";
	mysql_query($ins);
}

$del = "DELETE FROM lintasform WHERE userid='$username' AND idtrx='$idtrx'";
mysql_query($del);

$input = "INSERT INTO lintasform(kodetrx,userid,tgl,idtrx) 
			VALUES('$kode','$username',SYSDATE(),'$idtrx')";	
mysql_query($input);
$result = 1;
		
$data['result'] = $result;
echo json_encode($data);

?>