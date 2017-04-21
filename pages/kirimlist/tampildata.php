<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
$kode = $_GET[kode];
$username = $_SESSION[namauser];
	
$text 	= "SELECT
				a.kodeorder AS kodeorder,
				DATE_FORMAT(b.tglkirim, '%d/%m/%Y') AS tglkirim,
				c.nama_barang AS namabarang,
				a.jml - SUM(CASE WHEN b.jml IS NULL THEN 0 ELSE b.jml END) as jml,
				d.nama_perusahaan AS pemesan
			FROM
				orderproduk a
			INNER JOIN pengiriman b ON b.kodeorder = a.kodeorder
			LEFT JOIN barang c ON c.kode_barang = a.kode_barang
			LEFT JOIN customer d ON d.kode_customer = a.kode_customer
			WHERE
				a.kodekirim IS NOT NULL
			GROUP BY a.kodeorder";
		
$sql 	= mysql_query($text);		

		
	$no=1+$offset;
    while($r=mysql_fetch_array($sql)){
		echo '<tr>';
        echo '<td align="center">'.$no.'</td>';
        echo '<td align="center">'.$r['tglkirim'].'</td>';
        echo '<td>'.$r['kodeorder'].'</td>';
		echo '<td>'.$r['namabarang'].'</td>';
		if($r['jml']==0){
			echo "<td><span class='label label-success'><b>Terkirim Semua</b></span></td>";
		}else{
		echo '<td>'.$r['jml'].'&nbsp;Kg</td>';
        }
		echo '<td>'.$r['pemesan'].'</td>';
        echo "<td class='text-center'><a href='javascript:void(0)' onClick=\"cetak('$r[kodeorder]')\" title='SPM'>&nbsp;<i class='fa fa-print'> </i></a></td>";
		echo '</tr>';
		
		$no++;
    }
	
	
?>