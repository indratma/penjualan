$(document).ready(function() {
	tampil_perusahaanarea();
	tampil_judularea();
	tampil_produkarea();
	tampil_ketarea();
	tampil_nospk();
});						   

function tampil_perusahaanarea(){	
	$.ajax({
		type	: "POST",		
		url		: "pages/print/area_tujuan.php",
		data	: "idtrx=rptget",
		success	: function(data){
			$("#perusahaan_area").html(data);
		}
	});
}

function tampil_judularea(){	
	$.ajax({
		type	: "POST",		
		url		: "pages/print/area_judulspk.php",
		data	: "idtrx=rptget",
		success	: function(data){
			$("#judul_area").html(data);
		}
	});
}


function tampil_produkarea(){	
		
	$.ajax({
		type	: "POST",		
		url		: "pages/print/area_spk.php",
		data	: "idtrx=rptget",
		success	: function(data){
			$("#produk_area").html(data);
		}
	});
}
function tampil_ketarea(){	
		
	$.ajax({
		type	: "POST",		
		url		: "pages/print/area_ket.php",
		data	: "idtrx=rptget",
		success	: function(data){
			$("#ket_area").html(data);
		}
	});
}
function tampil_nospk(){	
		
	$.ajax({
		type	: "POST",		
		url		: "pages/print/area_nospk.php",
		data	: "idtrx=rptget",
		success	: function(data){
			$("#spk_area").html(data);
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