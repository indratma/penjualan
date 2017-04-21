if(getCookie("searchbyvend").length>0) {
	var p = getCookie("searchbyvend");
	$("#searchby").val(p)
	$("#cari").val(getCookie("carivend"));
}
else {
	$("#searchby").val("2");
}

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

$(document).ready(function() {	
	tampildata('1');	
});			

$('#searchby').change(function(){
	var pilihan = $('#searchby').val();
	if(pilihan=='2'){
		$("#cari").val("");	
		$("#cari").focus();	
	}else{					
		$("#cari").val("");	
		$("#cari").focus();					
	}
});	


$('#btnview').click(function(){
	tampildata('1');						 
});	

function tampildata(pageno){
	setCookie("nopagevend", pageno);
	if(getCookie("pagevend").length>0) {
		var pageno = getCookie("pagevend");
	}
	else {
		var pageno = pageno;
	}
	if(getCookie("carivend").length>0) {
		var kode = getCookie("carivend");
	}
	else {
		var kode = $("#cari").val();		
	}
	if(getCookie("searchbyvend").length>0) {
		var searchby = getCookie("searchbyvend");
	}
	else {
		var searchby = $("#searchby").val();
	}
	$.ajax({
		type	: "GET",		
		url		: "pages/banklain/tampildata.php",
		data	: "kode="+kode+
					"&searchby="+searchby+
					"&page="+pageno,
		success	: function(data){
			$("#tampildata").html(data);
			paging(pageno);
		}
	});
}	

function paging(pageno){	
	if(getCookie("carivend").length>0) {
		var kode = getCookie("carivend");
	}
	else {
		var kode = $("#cari").val();		
	}
	if(getCookie("searchbyvend").length>0) {
		var searchby = getCookie("searchbyvend");
	}
	else {
		var searchby = $("#searchby").val();
	}
	$.ajax({
		type	: "GET",		
		url		: "pages/banklain/paging.php",
		data	: "kode="+kode+
					"&searchby="+searchby+
					"&page="+pageno,
		success	: function(data){
			$("#paging").html(data);
			delCookie("pagevend");
			delCookie("carivend");
			delCookie("searchbyvend");
		}
	});
}

function editbl(kode){
	setCookie("searchbyvend", $("#searchby").val());
	setCookie("carivend", $("#cari").val());
	setCookie("pagevend", getCookie("nopagevend"));
	$.ajax({
		type	: "POST", 
		url		: "pages/banklain/lintasform.php",
		data	: "kode="+kode,
		dataType: "json",
		success	: function(data){
			if(data.result==1){
				window.location.assign('?mod=newbanklain');
			}
		}	
	});	
}

function hapusbl(kode){
	setCookie("searchbyvend", $("#searchby").val());
	setCookie("carivend", $("#cari").val());
	setCookie("pagevend", getCookie("nopagevend"));
	$.ajax({
		type	: "POST",
		url		: "pages/banklain/hapus.php",
		data	: "kdbanklain="+kode,
		dataType: "json",
		success	: function(data){
			tampildata("1");
		}
	});
}

