<?php
include "inc.koneksi.php";
include "fungsi_hdt.php";

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$username	= anti_injection($_POST[userid]);
$pass		= anti_injection(md5($_POST[password]));
// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  //echo "Sekarang loginnya tidak bisa di injeksi lho.".$username;
?>
<script>
	//alert('Sekarang loginnya tidak bisa di injeksi lho.');
	window.location.href='../index.html';
	
</script>
<?php
}else{
	$login	=mysql_query("SELECT * FROM userapp WHERE username='$username'");
	$ketemu	=mysql_num_rows($login);
	//$ketemu=1;
	if ($ketemu>0){
		$r		= mysql_fetch_array($login);
		$pwd	= $r[password];
		$online = $r[online];
		$ipaddress =empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])? $_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP'];
		
		if ($r[blokir] == 'Y'){
			salah_blokir($username);
			return false;
		}
		if ($pwd==$pass){
			if ($online=='1' and $ipaddress!=$r[ipaddress]){
				username_aktif($username);
			}else{	
				sukses_masuk($username,$pass);
			}	
		}else{
			session_start();
			$salah =1;
			$_SESSION[salah]=$_SESSION[salah]+$salah;
			if ($_SESSION[salah]>=3){
				blokir($username);
			}
			salah_password();
		}
	}else{
		salah_username($username);
	}
}
?>
