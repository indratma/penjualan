<?php
$mod 		= $_GET['mod'];

if($mod=='home'){
	//include "pages/fleetavailable/fleetavailable.php";
	include "pages/dashboard/home.php";
}
elseif ($mod=='prdct'){
	include "pages/barang/product.php";
}elseif ($mod=='newprdct'){
	include "pages/barang/entriproduct.php";
}elseif ($mod=='jarak'){
    include "pages/jarak/jarak.php";	
}elseif ($mod=='newjarak'){
    include "pages/jarak/entrijarak.php";	
}elseif ($mod=='cust'){
    include "pages/customer/customer.php";
}elseif ($mod=='newcust'){
    include "pages/customer/entricustomer.php";		
}elseif ($mod=='newcudast'){
    include "pages/customer/entricustomer.php";	
}
elseif ($mod=='tambahorder'){
    include "pages/orderproduk/inputorder.php"; 
}
elseif ($mod=='editorder'){
    include "pages/orderproduk/editorder.php"; 
}
elseif ($mod=='daftarorder'){
    include "pages/orderlist/listorder.php"; 
}
elseif ($mod=='tambahkirim'){
    include "pages/kirimbarang/inputkirim.php"; 
}
elseif ($mod=='editkirim'){
    include "pages/kirimbarang/editkirim.php"; 
}
elseif ($mod=='daftarkirim'){
    include "pages/kirimlist/listkirim.php"; 
}
elseif ($mod=='tambahspm'){
    include "pages/orderproduk/inputspm.php"; 
}
elseif ($mod=='tambahspk'){
    include "pages/orderproduk/inputspk.php"; 
}
elseif ($mod=='daftarspm'){
    include "pages/orderlist/listspm.php"; 
}
elseif ($mod=='printspm'){
    include "pages/print/printspm.php"; 
}
elseif ($mod=='printspk'){
    include "pages/print/printspk.php"; 
}
elseif ($mod=='printsj'){
    include "pages/print/printsj.php"; 
}
elseif ($mod=='reportorder'){
    include "pages/report/reportorder.php"; 
}
elseif ($mod=='viewreport'){
    include "pages/report/viewreport.php"; 
}
elseif ($mod=='exit'){
    include "pages/logout.php";	
}else{
  header('location:index.html');
}
?>
