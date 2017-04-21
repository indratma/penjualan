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

$text 	= "SELECT kode_customer,CONCAT(nama_perusahaan,' - ',nama_customer) AS customer,CONCAT(alamat,' ',kota) AS alamat,notelp,nohp
			FROM customer WHERE onview=1 ";
if(!empty($kode)){			
	$text 	= $text."AND (nama_perusahaan LIKE '%$kode%' OR alamat LIKE '%$kode%' OR kota LIKE '%$kode%') ";
}	
$text 	= $text."ORDER BY nama_customer LIMIT $offset, $dataPerPage";					
$sql 	= mysql_query($text);	

echo "
	<table class='table table-bordered'>
		<tr style='background-color:#f9f9f9'>
			<th style='width:10px' class='text-center'>No</th>
			<th style='width:200px' class='text-center'>Nama Customer</th>	
			<th style='width:200px' class='text-center'>Alamat</th>
			<th style='width:100px' class='text-center'>No Telp</th>
			<th style='width:100px' class='text-center'>No HP</th>
			<th style='vertical-align: middle;width:120px' class='text-center'>Aksi</th>
		</tr>";		
	
		$no=1+$offset;
		while($rec = mysql_fetch_array($sql)){				
			echo "
				<tr>
					<td class='text-center'>$no.</td>
					<td >$rec[customer]</td>
					<td >$rec[alamat]</td>
					<td class='text-center'>$rec[notelp]</td>
					<td class='text-center'>$rec[nohp]</td>
					<td class='text-center'>&nbsp;
						<a href='javascript:void(0)' onClick=\"edit('$rec[kode_customer]')\" title='Edit'>Edit</a> &nbsp;&nbsp;| 
						<a href='javascript:void(0)' onClick=\"hapus('$rec[kode_customer]')\" title='Hapus'>&nbsp; Hapus</a>
					</td>
                </tr>";					
			$no++;						
		}	
		
echo "
	</table>
	";

?>