<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";


$username 	= $_SESSION[namauser];

$text 	= "SELECT kodeperusahaan,namaitem,armada,tglmulai,tglakhir,idtrx FROM lintasreport WHERE userid='$username'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kdprshn 	= $rs[kodeperusahaan];
$tgl1 		= $rs[tglmulai];
$tgl2 		= $rs[tglakhir];
$idtrx 		= $rs[idtrx];
$armada		= $rs[armada];
$barang		= $rs[namaitem];

	$text 	= "SELECT a.kodetrx,DATE_FORMAT(a.tglpakai,'%d/%m/%Y') AS tglpakai,b.namabrg,CONCAT(c.namaarmada,' (',a.armada,') ') AS armada,a.qty
				FROM pakaibrg a 
				LEFT JOIN dberp_dummy.barang b ON a.kodebrg=b.kodebrg
				LEFT JOIN armada c ON c.nopol=a.armada";
	
	if(!empty($armada)){
		$text 	= $text."WHERE a.armada='$armada' ";
	}
	
/*	if(!empty($namaitem)){
		$text 	= $text."AND a.namabrg='$barang' ";
	}
*/	
	$text 	= $text." ORDER BY a.tglpakai DESC";					

	 
	$sql 	= mysql_query($text);	
	
	echo "
		<table class='table table-bordered'>
			<thead style='background-color:#f9f9f9'>
				<tr>
					<th style='width:20px' class='text-center'>No</th>
					<th style='width:100px' class='text-center'>Tgl Pakai</th>
					<th style='width:200px' class='text-center'>Kode Pemakaian Barang</th>
					<th style='width:250px' class='text-center'>Armada</th>
					<th style='width:200px' class='text-center'>Jumlah</th>				
				</tr>
			</thead>
			<tbody>";		
			
			$no=1+$offset;
			while($rec = mysql_fetch_array($sql)){	
				
				echo "
					<tr>
						<td class='text-center'>$no.</td>
						<td class='text-center'>$rec[tglpakai]</td>
						<td class='text-center'>$rec[kodetrx]</td>
						<td >$rec[armada]</td>
						<td >$rec[qty]</td>
						
					</tr>";	
					
				$no++;						
			}	
			
	echo "	$text </tbody>
		</table>";
	

?>