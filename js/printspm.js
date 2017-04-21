$(document).ready(function() {
	tampil_perusahaanarea();
	tampil_judularea();
	tampil_produkarea();
});						   

function tampil_perusahaanarea(){	
	$.ajax({
		type	: "POST",		
		url		: "pages/print/area_perusahaan.php",
		data	: "idtrx=rptget",
		success	: function(data){
			$("#perusahaan_area").html(data);
		}
	});
}

function tampil_judularea(){	
	$.ajax({
		type	: "POST",		
		url		: "pages/print/area_judul.php",
		data	: "idtrx=rptget",
		success	: function(data){
			$("#judul_area").html(data);
		}
	});
}


function tampil_produkarea(){	
		
	$.ajax({
		type	: "POST",		
		url		: "pages/print/area_produk.php",
		data	: "idtrx=rptget",
		success	: function(data){
			$("#produk_area").html(data);
		}
	});
}

/*function getreccount(){		
	$.ajax({
		type	: "POST",		
		url		: "pages/toapprove/getdatacount.php",
		dataType: "json",
		success	: function(data){
			if(data.jmlrec==0){
				window.location.assign('?mod=toap');
			}else{
				tampil_produkarea();
			}
		}
	});
}
*/