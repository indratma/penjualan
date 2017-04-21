<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_terbilang.php";

$moneyFormat = new moneyFormat();
$username 	= $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kode 	= $rs[kodetrx];

$text 	= "SELECT a.kodepermintaan,DATE_FORMAT(a.tglmohon,'%d/%m/%Y') AS tglpengajuan,b.nama,CONCAT('Divisi ',c.namadivisi,' - ',b.nama) AS pemohon,
			CONCAT(d.namajabatan,' ',c.namadivisi) AS jabatan FROM permintaan a 
			LEFT JOIN karyawan b ON b.nik=a.pemohon
			LEFT JOIN divisi c ON c.kode_divisi=b.kode_divisi
			LEFT JOIN jabatan d ON d.kode_jabatan=b.kode_jabatan
			WHERE a.kodepermintaan='$kode'";
			
$sql 	= mysql_query($text);	
$rec 	= mysql_fetch_array($sql);

$pemohon 		= $rec[pemohon];
$pic	 		= $rec[nama];
$tglpengajuan 	= $rec[tglpengajuan];
$kode 			= $rec[kodepermintaan];
$jabatan		= $rec[jabatan];

if(substr($kode,4,2)=='PD'){
	$text 	= "SELECT a.perihal,b.nama_supplier,b.ktp,b.alamat,a.jml,a.ket,
				c.nama,d.namadivisi,c.alamat FROM permintaandana_detail a 
				LEFT JOIN supplier b ON b.kode_supplier=a.penerima
				LEFT JOIN karyawan c ON c.nik=a.penerima
				LEFT JOIN divisi d ON d.kode_divisi=c.kode_divisi WHERE a.kodepermintaan='$kode'";
	$query 	= mysql_query($text);
	$rs 	= mysql_fetch_array($query);
	$perihal= $rs[perihal];		
	$jmldisetujui = $rs[jml];
	
		echo"	
		<p>Yang bertandatangan di bawah ini :</p>
		<table class='text-left'>
			<tr>
				<td style='width:50px'></td>
				<td style='width:100px'>Nama</td>
				<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
				<td style='width:300px'><b>$pic</b></td>
			</tr>
			<tr>
				<td style='width:50px'></td>
				<td style='width:100px'>Jabatan</td>
				<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
				<td style='width:300px'><b>$jabatan</b></td>
			</tr>
		</table><br>";
		if($perihal==1){
			echo "	
				<p>Mengajukan Uang Muka untuk Supplier atas nama sbb :</p>";
		}elseif($perihal==2){	
			echo "	
				<p>Mengajukan pinjaman untuk Supplier atas nama sbb :</p>";
		}elseif($perihal==3){	
			echo "	
				<p>Mengajukan pinjaman untuk Karyawan atas nama sbb :</p>";
		}else{
			echo "	
				<p>Mengajukan Permohonan Dana untuk kegiatan Sosial atau Keagamaan melalui karyawan atas nama sbb :</p>";
		}						
		
		if($perihal==1 or $perihal==2){
			echo "		
			<table class='text-left'>
				<tr>
					<td style='width:50px'></td>
					<td style='width:100px'>Nama</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$rs[nama_supplier]</b></td>
				</tr>
				<tr>
					<td style='width:50px'></td>
					<td style='width:100px'>No KTP</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$rs[ktp]</b></td>
				</tr>
				<tr>
					<td style='width:50px'></td>
					<td style='width:100px'>Alamat</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$rs[alamat]</b></td>
				</tr>
			</table><br>";
		}else{
			echo "		
			<table class='text-left'>
				<tr>
					<td style='width:50px'></td>
					<td style='width:100px'>Nama</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$rs[nama]</b></td>
				</tr>
				<tr>
					<td style='width:50px'></td>
					<td style='width:100px'>Divisi</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$rs[namadivisi]</b></td>
				</tr>
				<tr>
					<td style='width:50px'></td>
					<td style='width:100px'>Alamat</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$rs[alamat]</b></td>
				</tr>
			</table><br>";
		}
		
		$text 	= "SELECT jml FROM dana_disetujui WHERE kodepermintaan='$kode' ORDER BY kodeproses DESC LIMIT 1";					
		$q	 	= mysql_query($text);	
		$jmlrc	= mysql_num_rows($q);					
		if($jmlrc>0){
			$recs  = mysql_fetch_array($q);
			$jmldisetujui = $recs[jml];			
		}	
		
		$terbilang = $moneyFormat->terbilang($jmldisetujui);
		
		echo "	
		<dd>Sebesar <a href='javascript:void(0)' onClick=\"update_dana('$perihal')\">Rp. <b>".number_format($jmldisetujui,2,',','.')." ($terbilang Rupiah)</b></a> $rs[ket]</dd><br>
		<dd>Demikian pengajuan pinjaman ini kami buat untuk dapat disetujui. Atas perhatian Bapak/ Ibu kami ucapkan terima kasih.";

}elseif(substr($kode,4,2)=='KH'){	
	$text 	= "SELECT noref FROM konfirmharga WHERE kodeconfirm='$kode'";
	$q	 	= mysql_query($text);
	$recs 	= mysql_fetch_array($q);
	$noref	= $recs[noref];
	echo "
		<div class='col-sm-12'>
			<table class='text-left'><br>
				<tr>
					<td style='width:150px'></td>
					<td style='width:3px'></td>
					<td style='width:300px'></td>
				</tr>			
				<tr>
					<td style='width:150px'>No Konfirmasi</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$kode</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Tgl Konfirmasi</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$tglpengajuan</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Pemohon</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$pemohon</b></td>
				</tr>
				<tr></tr>
				<tr>
					<td style='width:150px'>No Referensi</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$noref</b></td>
				</tr>
			</table>
		</div>";
	
}elseif(substr($kode,4,2)=='PB'){	
	$text 	= "SELECT kodepermintaan,perihal FROM permintaanbrg_detail WHERE kodepermintaan='$kode'";
	$q	 	= mysql_query($text);
	$recx 	= mysql_fetch_array($q);
	$perihal= $recx[perihal];
	echo "
		<div class='col-sm-12'>
			<table class='text-left'><br>
				<tr>
					<td style='width:150px'></td>
					<td style='width:3px'></td>
					<td style='width:300px'></td>
				</tr>			
				<tr>
					<td style='width:150px'>No Pengajuan</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$kode</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Tgl Pengajuan</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$tglpengajuan</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Pemohon</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$pemohon</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Perihal</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$perihal</b></td>
				</tr>
			</table>
		</div>";
}elseif(substr($kode,4,2)=='PJ'){	
	$text 	= "SELECT kodepermintaan,perihal FROM pengadaanjasa_detail WHERE kodepermintaan='$kode'";
	$q	 	= mysql_query($text);
	$recxx 	= mysql_fetch_array($q);
	$perihal= $recxx[perihal];
	echo "
		<div class='col-sm-12'>
			<table class='text-left'><br>
				<tr>
					<td style='width:150px'></td>
					<td style='width:3px'></td>
					<td style='width:300px'></td>
				</tr>			
				<tr>
					<td style='width:150px'>No Pengajuan</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$kode</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Tgl Pengajuan</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$tglpengajuan</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Pemohon</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$pemohon</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Perihal</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$perihal</b></td>
				</tr>
			</table>
		</div>";

}else{	
	echo "
		<div class='col-sm-12'>
			<table class='text-left'><br>
				<tr>
					<td style='width:150px'></td>
					<td style='width:3px'></td>
					<td style='width:300px'></td>
				</tr>			
				<tr>
					<td style='width:150px'>No Pengajuan</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$kode</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Tgl Pengajuan</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$tglpengajuan</b></td>
				</tr>
				<tr>
					<td style='width:150px'>Pemohon</td>
					<td style='width:3px'>&nbsp;<b>:</b>&nbsp;</td>
					<td style='width:300px'><b>$pemohon</b></td>
				</tr>
			</table>
		</div>";
}
		
?>