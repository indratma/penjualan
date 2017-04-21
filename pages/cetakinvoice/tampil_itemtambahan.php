<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodeorder		= $_POST[kodeorder];

$text 	= "SELECT kodeorder, index_item, ket, rpbiaya FROM ordersewa_biayatambahan WHERE kodeorder='$kodeorder' ORDER BY index_item";
$sql 	= mysql_query($text);	

echo "
<table class='table table-bordered'>
	<thead style='background-color:#f9f9f9'>
		<tr>
			<th style='width:30px' class='text-center'>No</th>
			<th style='width:210px' class='text-center'>Ket</th>
			<th class='text-center'>Rp Biaya</th>
			<th class='text-center'>Aksi</th>
		</tr>
	</thead>
	<tbody>";
		$no=1;
		while($rec = mysql_fetch_array($sql)){				
			echo "
				<tr>
                 	<td class='text-center'>$no.</td>
                    <td >$rec[ket]</td>
					<td class='text-right'>$rec[rpbiaya]</td>
					<td class='text-center'>
						<a href='javascript:void(0)' onClick=\"delitemtambahan('$rec[index_item]')\">Hapus</a>
					</td>
                </tr>";	
		$no++;						
		}
		
		if($jmlrec<3){
			while($no<=3){				
				echo "
					<tr>
						<td class='text-center'>$no.</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>";	
			$no++;						
			}								
		}
		
echo "</tbody>
	</table>";
?>