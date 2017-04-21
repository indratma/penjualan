<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodeorder		= $_POST[kodeorder];

$text 	= "SELECT nosuratjalan AS suratjalan, index_sj FROM suratjalan WHERE kodeorder='$kodeorder'";
$sql 	= mysql_query($text);	

echo "
<table class='table table-bordered'>
	<thead style='background-color:#f9f9f9'>
		<tr>
			<th style='width:30px' class='text-center'>No</th>
			<th style='width:210px' class='text-center'>Surat Jalan</th>
			<th style='width:210px' class='text-center'>Aksi</th>
		</tr>
	</thead>
	<tbody>";
		$no=1;
		while($rec = mysql_fetch_array($sql)){				
			echo "
				<tr>
                 	<td class='text-center'>$no.</td>
                    <td >$rec[suratjalan]</td>
					<td class='text-center'>
						<a href='javascript:void(0)' onClick=\"delsuratjalan('$rec[index_sj]')\">Hapus</a>
					</td>
                </tr>";	
		$no++;						
		}
		
		if($jmlrec<5){
			while($no<=5){				
				echo "
					<tr>
						<td class='text-center'>$no.</td>
						<td></td>
						<td></td>
					</tr>";	
			$no++;						
			}								
		}
		
echo "</tbody>
	</table>";
?>