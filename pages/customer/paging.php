<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kode = $_GET[kode];

$dataPerPage = 10;
if(isset($_GET['page']))
{
$noPage = $_GET['page'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $dataPerPage;

if(empty($tgl)){
	$tgl1 = date("d/m/Y");
	$tgl2 = date("d/m/Y");
}else{	
	$tgl1 = substr($tgl,0,10);
	$tgl2 = substr($tgl,13);
}	
	
$text 	= "SELECT COUNT(*) AS jumData FROM customer WHERE onview=1 ";
if(!empty($kode)){			
	$text 	= $text."AND (nama_customer LIKE '%$kode%' OR alamat LIKE '%$kode%' OR kota LIKE '%$kode%')";
}	
$hasil  = mysql_query($text);
$data   = mysql_fetch_array($hasil);

$jumData = $data['jumData'];
$jumPage = ceil($jumData/$dataPerPage);

// menampilkan navigasi paging
echo "<ul class='pagination pagination-sm no-margin pull-right'>";
if ($noPage > 1) echo  "<li><a href='javascript:void(0)' onClick=\"tampildata('".($noPage-1)."')\"><< Prev</a></li>";
for($page = 1; $page <= $jumPage; $page++)
{
	if ((($page >= $noPage - 2) && ($page <= $noPage + 2)) || ($page == 1) || ($page == $jumPage))
	{
	  if (($showPage == 1) && ($page != 2))  echo "<li class='disabled'><a href='#'>...</a></li>";
	  if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "<li class='disabled'><a href='#'>...</a></li>";
	  if ($page == $noPage) echo "<li class='active'><a href='#'>".$page."</a></li>";
	  else echo "<li><a href='javascript:void(0)' onClick=\"tampildata('".$page."')\">".$page."</a></li>";
	  $showPage = $page;
	}
}

if ($noPage < $jumPage) echo "<li><a href='javascript:void(0)' onClick=\"tampildata('".($noPage+1)."')\">Next >></a></li>";

echo "</ul>";   
	
?>