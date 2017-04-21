$(document).ready(function() {
	tampildata();
	
});	

function setCookie(cname, cvalue) {
    var expires = "expires=0";
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function delCookie(cname) {
	document.cookie = cname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
}

$(function() {
	$('#txttglorder').daterangepicker({format: 'DD/MM/YYYY'});	
});	

function tampildata(){
	$.ajax({
		type	: "POST",		
		url		: "pages/cetakinvoice/dataprint.php",
		dataType : "json",
		success	: function(data){
			$("#kodeinvoice").html(data.kodeinvoice);
			$("#tglorder").html(data.tglorder);
			$("#tglinvoice").html(data.tglinvoice);
			$("#marketing").html(data.marketing);
			$("#alamat").html(data.alamat);
			$("#kota").html(data.kota);
			$("#notelp").html(data.notelp);
			$("#nohp").html(data.nohp);
			$("#namabrg").html(data.namabrg);
			$("#armada").html(data.armada);
			$(".nama_perusahaan").html(data.nama_perusahaan);
			$("#kotaasal").html(data.kotaasal);
			$("#kotatujuan").html(data.kotatujuan);
			$("#tglmuat").html(data.tglmuat);
			$("#tglsampai").html(data.tglsampai);
			$("#berat").html(data.berat);
			$(".biayasewa").html(data.biayasewa);
			$("#subtot").html(data.subtot);
			$("#grandtot").html(data.grandtot);
			$("#terbilang").html(data.terbilang);
			$("#catatan").html(data.catatan);
			$(".pencetak").html(data.pencetak);
			$("#suratjalan").html(data.suratjalan);
			$("#itemtambahan").html(data.itemtambahan);
			$("#rpitemtambahan").html(data.rpitemtambahan);
			tampilsuratjalan();
			tampilistemtambahan();
		}
	});
}	
function tampilsuratjalan(){
	$.ajax({
		type	: "POST", 
		url		: "pages/cetakinvoice/tampillist_sj.php",
		success	: function(data){
			$("#tblsj").html(data);
		}
	});
}

function tampilistemtambahan(){
	$.ajax({
		type	: "POST", 
		url		: "pages/cetakinvoice/tampillist_itemtambahan.php",
		success	: function(data){
			$("#tblitemtambahan").html(data);
		}
	});
}
function diprint(kode){
	$.ajax({
		type	: "POST", 
		url		: "pages/cetakinvoice/simpan.php",
		data	: "kode="+kode,
		dataType: "json",
		success	: function(data){
			window.location.assign('?mod=prevp'); 
		}	
	});	
}

