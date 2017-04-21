<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
$kode = $_GET['kodespm'];
$username = $_SESSION[namauser];
	
$query=mysql_query("SELECT
						a.kodespm AS kodespm,
						a.kodeorder as kodeorder,
						a.jml as jumlah,
						b.nama_perusahaan AS customer,
						CONCAT(b.alamat, ' , ', b.kota) AS alamat
					FROM
						orderproduk a
					INNER JOIN customer b ON b.kode_customer = a.kode_customer
					WHERE a.kodespm IS NOT NULL
					")or die(mysql_error());
    //$show=mysql_query($query) or die ("Error");
	if(mysql_num_rows($query) == 0){	//ini artinya jika data hasil query di atas kosong
			
			echo '<tr><td>Tidak ada data!</td></tr>';
			
		}else{	
		
	$no=1;
    while($r=mysql_fetch_array($query)){
		echo '<tr>';
        echo '<td align="center">'.$no.'</td>';
        echo '<td style="width:50px">'.$r['kodespm'].'</td>';
        echo '<td align="center">'.$r['kodeorder'].'</td>';
		echo '<td>'.$r['jumlah'].'&nbsp; Kg</td>';
		echo '<td>'.$r['customer'].'</td>';
		echo '<td>'.$r['alamat'].'</td>';
        echo '</tr>';
		
		$no++;
    }
	}
	
?>