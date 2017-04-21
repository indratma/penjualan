<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";

$kode = $_GET[kode];
$tglorder = $_GET[tglorder];

if(empty($tgl)){
	$tgl1 = date("d/m/Y");
	$tgl2 = date("d/m/Y");
}else{	
	$tgl1 = substr($tgl,0,10);
	$tgl2 = substr($tgl,13);
}	

$tgl1x 	= str_replace("/","-",$tgl1);
$tgl1 	= jin_date_sql($tgl1x);

$tgl2x 	= str_replace("/","-",$tgl2);
$tgl2 	= jin_date_sql($tgl2x);

$dataPerPage = 15;
if(isset($_GET['page']))
{
$noPage = $_GET['page'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $dataPerPage;
	
$text = "SELECT
			COUNT(*) AS jumData
		FROM
			orderproduk a
		LEFT JOIN customer b ON b.kode_customer = a.kode_customer
		WHERE COALESCE(a.kdrealisasi, '') = '' ";

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