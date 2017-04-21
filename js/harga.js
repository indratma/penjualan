$(document).ready(function() {						   
	tampildata('1');
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

function tampildata(pageno){
	setCookie("nopagecstmr", pageno);
	if(getCookie("pagecstmr").length>0) {
		var pageno = getCookie("pagecstmr");
	}else {
		var pageno = pageno;
	}
	if(getCookie("caricstmr").length>0) {
		var kode = getCookie("caricstmr");
	}else {
		var kode = $("#cari").val();
	}
	
	$.ajax({
		type	: "GET",		
		url		: "pages/harga/tampildata.php",
		data	: "kode="+kode+
					"&page="+pageno,
		success	: function(data){
			$("#tampildata").html(data);
			paging(pageno);
		}
	});
}	

function paging(pageno){
	if(getCookie("caricstmr").length>0) {
		var kode = getCookie("caricstmr");
	}else {
		var kode = $("#cari").val();
	}
	$.ajax({
		type	: "GET",		
		url		: "pages/harga/paging.php",
		data	: "kode="+kode+
					"&page="+pageno,
		success	: function(data){
			$("#paging").html(data);
			delCookie("caricstmr");
			delCookie("pagecstmr");
		}
	});
}

function edit(kode){
	setCookie("pagecstmr", getCookie("nopagecstmr"));
	setCookie("caricstmr", $("#cari").val());
	$.ajax({
		type	: "POST", 
		url		: "pages/harga/lintasform.php",
		data	: "kode="+kode,
		dataType: "json",
		success	: function(data){
			if(data.result==1){
				window.location.assign('?mod=newharga');
			}
		}	
	});	
}

$("#cari").keyup(function(){
	tampildata('1');	
});						  

$('#btndel').click(function(){							
	var kode = getCookie("caricstmr");
	$.ajax({
		type	: "POST",
		url		: "pages/harga/hapus.php",
		data	: "kode="+kode,
		dataType: "json",
		success	: function(data){
			$("#confirm-modal").modal('hide');
			$("#info-modal").modal('toggle');
			$("#info-modal").modal('show');
			$("#infone").html(data.info);
			delCookie("caricstmr");
			tampildata('1');
		}
	});	
});

function hapus(kode){
	setCookie("pagecstmr", getCookie("nopagecstmr"));
	setCookie("caricstmr", kode);
	$("#confirm-modal").modal('toggle');
	$("#confirm-modal").modal('show');	
}