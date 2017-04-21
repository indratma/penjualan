<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,2,',','.');
  return $rupiah;
}
?> 
