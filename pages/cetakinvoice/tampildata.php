<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";

$kode 		= $_GET[kode];
$sortby 	= $_GET[sortby];
$tglorder 	= $_GET[tglorder];


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

$dataPerPage = 10;
if(isset($_GET['page']))
{
$noPage = $_GET['page'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $dataPerPage;

$text 	= "SELECT a.kodeorder, DATE_FORMAT(a.tglmuat,'%d-%m-%Y') AS tglmuat, DATE_FORMAT(a.tglbongkar,'%d-%m-%Y') AS tglbongkar,a.noinvoice,a.subtot,b.kode_customer,b.nama_perusahaan 
			AS customer,CONCAT(c.namaarmada,' (',REPLACE(c.nopol,'-',' '),')') AS armada FROM ordersewa a 
			LEFT JOIN customer b ON b.kode_customer=a.kode_customer
			LEFT JOIN armada c ON c.nopol=a.armada
			WHERE a.kodecetak='0' ";
if(!empty($kode)){			
	$text 	= $text."AND (c.namaarmada LIKE '%$kode%' OR b.nama_customer LIKE '%$kode%' OR b.nama_perusahaan LIKE '%$kode%' OR a.kodeorder LIKE '%$kode%' OR  a.noinvoice LIKE '%$kode%' ) ";
}	
if(!empty($tglorder)){			
	$text 	= $text."AND a.tglorder>='$tgl1' AND a.tglorder<='$tgl2' ";
}	
if(empty($sortby)){
$text 	= $text."ORDER BY a.tglmuat DESC LIMIT $offset, $dataPerPage";
}
if($sortby=='invoice'){
$text 	= $text."ORDER BY a.noinvoice DESC, a.tglmuat DESC LIMIT $offset, $dataPerPage";
}					
$sql 	= mysql_query($text);	

echo "
	<table class='table table-bordered'>
		<tr style='background-color:#f9f9f9'>
			<th style='vertical-align: middle;width:20px' class='text-center'>No</th>
			<th style='vertical-align: middle;width:90px' class='text-center'>Tgl Muat</th>
			<th style='vertical-align: middle;width:90px' class='text-center'>Tgl Bongkar</th>
			<th style='vertical-align: middle;width:90px' class='text-center'>No. Invoice</th>
			<th style='vertical-align: middle;width:160px' class='text-center'>Armada</th>				
			<th style='vertical-align: middle;width:120px' class='text-center'>Customer</th>
			<th style='vertical-align: middle;width:90px' class='text-center'>Jml Biaya</th>	
			<th style='vertical-align: middle;width:90px' class='text-center'>Aksi</th>
		</tr>";		
	
		$no=1+$offset;
		while($rec = mysql_fetch_array($sql)){
					
			echo "
				<tr>
					<td class='text-center'>$no.</td>
					<td class='text-center'>$rec[tglmuat]</td>
					<td class='text-center'>$rec[tglbongkar]</td>
                 	<td class=' text-center'>$rec[noinvoice]</td>					
					<td class='text-center'>$rec[armada]</td>
					<td class='text-center'>$rec[customer]</td>
					<td class='text-center'>".number_format($rec[subtot],2,',','.')."</td>					
					<td class='text-center'>
						<a href='javascript:void(0)' onClick=\"invoice('$rec[kodeorder]')\" title='input'>Invoice</a> | 
						<a href='javascript:void(0)' onClick=\"cetak('$rec[kodeorder]')\" title='Edit'>Cetak</a>
					</td>
                </tr>";					
			$no++;						
		}	
		
echo "
	</table>
	";

?>