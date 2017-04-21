<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username 	= $_SESSION[namauser];


$text 	= "SELECT tampilanlain,alamat,notelp FROM perusahaan WHERE kodeperusahaan='ITRD'";
$sql 	= mysql_query($text);	
$r 	= mysql_fetch_array($sql);
$namaperusahaan = $r['tampilanlain'];
$alamat 		= $r['alamat'];
$notelp	 		= $r['notelp'];

echo "
	<table class='table invoice-total'>
                                <tbody>
                                <tr>
                                    <td><strong>To </strong></td>
                                    <td>$namaperusahaan</td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td>$alamat</td>
                                </tr>
                                <tr>
                                    <td><strong>Person</strong></td>
                                    <td>Bp Hengky</td>
                                </tr>
                                </tbody>
                            </table>";                            
	
?>