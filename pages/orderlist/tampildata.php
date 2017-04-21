<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
$kode = $_GET['kodeorder'];
	
	
$query=mysql_query("SELECT
				a.kodeorder,
				DATE_FORMAT(a.tglorder, '%d/%m/%Y') AS tglorder,
				c.nama_barang as nama,
				a.jml as jumlah,
				b.nama_perusahaan AS customer,
				CONCAT(b.alamat, ' , ', b.kota) AS  alamat
			FROM
				orderproduk a
			LEFT JOIN customer b ON b.kode_customer = a.kode_customer
			LEFT JOIN barang c ON c.kode_barang = a.kode_barang
			WHERE COALESCE(a.kodekirim,'')=''")or die(mysql_error());
    //$show=mysql_query($query) or die ("Error");
	if(mysql_num_rows($query) == 0){	//ini artinya jika data hasil query di atas kosong
			
			echo '<tr><td>Tidak ada data!</td></tr>';
			
		}else{	
		
	$no=1;
    while($r=mysql_fetch_array($query)){
		echo '<tr>';
        echo '<td align="center">'.$no.'</td>';
        echo '<td style="width:50px">'.$r['tglorder'].'</td>';
        echo '<td align="center">'.$r['nama'].'</td>';
        echo '<td>'.$r['jumlah'].'&nbsp; Kg</td>';
        echo '<td>'.$r['customer'].'</td>';
        echo '<td>'.$r['alamat'].'</td>';
        echo "<td><a href='javascript:void(0)' onClick=\"spm('$r[kodeorder]')\" title='SPM'>&nbsp; Buat SPM</a></td>";
		echo '</tr>';
		
		$no++;
    }
	}
	
?>