$(document).ready(function(){
	
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

  function tampildata(){
	var kode 	= $("#tampildata").val();
	$.ajax({
		type	: "GET",		
		url		: "pages/kirimlist/tampildata.php",
		data	: "kode="+kode,
		success	: function(data){
			$("#tampildata").html(data);
			
		}
	});
}	
$(function() {
			$('.footable').footable();
            $('.footable2').footable();
});	

function cetak(kode){

	$.ajax({
		type	: "POST", 
		url		: "pages/kirimlist/lintasform.php",
		data	: "kode="+kode,
		dataType: "json",
		success	: function(data){
			if(data.result==1){
				window.location.assign('?mod=printsj'); 
			}
		}	
	});	
}