<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_koma.php";

$username 		= $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username' AND idtrx='prevp'";
$sql 	= mysql_query($text);
$tampil = mysql_fetch_array($sql);
$kode 	= $tampil[kodetrx];


$text 	= "SELECT nosuratjalan AS suratjalan FROM suratjalan WHERE kodeorder='$kode'";
$sql 	= mysql_query($text);
	
$jmlrec	= mysql_num_rows($sql);

if ($jmlrec > 0){
echo "
<table  >
	
	<tbody>
		<tr>
			<td  style='width:100px'>Surat Jalan</td>
			<td></td>
		</tr>
		";
		$no=1;
		while($rec = mysql_fetch_array($sql)){				
			echo "
				
				<tr>
                    <td> - $rec[suratjalan]</td>
                </tr>";	
		$no++;						
		}
		
		if($jmlrec<10){
			while($no<=10){				
				echo "
					<tr>
						<td></td>
					</tr>";	
			$no++;						
			}								
		}
		
echo "</tbody>
	</table>";
}
?>