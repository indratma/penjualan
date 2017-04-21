<?php
include "inc/inc.koneksi.php";
include "inc/fungsi_hdt.php";

  	session_start();
  
  	if ($_SESSION[login]== 1){
		$sql = "UPDATE userapp SET online=0,lastupdate=now() WHERE username='$_SESSION[namauser]'";
  		mysql_query($sql);
	}	
	
  	session_destroy();
  	header("location:index.html");
	
?>