$(document).ready(function() {	
	isi_cborder();
	tampil_data();
});						   

$(function() {   
   $(".select2_demo_3").select2({
                placeholder: "Silahkan Pilih",
                allowClear: true
            });
	});


function isi_cborder(){
	$.ajax({
		type: 'POST', 
		url: 'pages/orderproduk/tampilkan_semuaorder.php',
		success: function(response) {
			$('#cborder').html(response); 
		}
	});	
}

$('#cborder').change(function(){
	cari_order();
});

function cari_order(){
	var kodeorder 	= $("#cborder").val();
	$.ajax({
		type	: "POST", 
		url		: "pages/orderproduk/cariorder.php",
		data	: "kodeorder="+kodeorder,
		dataType: "json",
		success	: function(data){
			 
		}	
	});
}


$('#btnconfirm').click(function(){
	
	var kodeorder		= $("#cborder").val();
	var produk			= $("#txtproduk").val();
	var berat			= $("#txtberat").val();
	var karungtot		= $("#txtkarungtot").val();
	var total			= $("#txttotal").val();
	var ket				= $("#txtket").val();
	
//validasi
		
	if(kodeorder.length==0){
		$("#warningx").text('Nomor PO belum dipilih !');
		return false;
	}
	if(berat.length==0){
		$("#warningx").text('Berat karung tidak boleh kosong !');
		return false;
	}
	if(karungtot.length==0){
		$("#warningx").text('Jumlah karung tidak boleh kosong !');
		return false;
	}
	
	
	$("#confirm-modal").modal('toggle');
	$("#confirm-modal").modal('show');
	
});

function simpandata(){	
	var kodeorder		= $("#cborder").val();
	var produk			= $("#txtproduk").val();
	var berat			= $("#txtberat").val();
	var karungtot		= $("#txtkarungtot").val();
	var ket				= $("#txtket").val();
							
	$.ajax({
		type	: "POST", 
		url		: "pages/orderproduk/simpanspk.php",
		data	: "kodeorder="+kodeorder+
				"&produk="+produk+
				"&berat="+berat+
				"&karungtot="+karungtot+
				"&ket="+ket,
		timeout	: 3000,
		success	: function(data){
			$("#confirm-modal").modal('hide');
			$("#info-modal").modal('toggle');
			$("#info-modal").modal('show');
			$("#infone").html(data);
		}	
	});
		
}

$('#btnsave').click(function(){
	simpandata();
});

function report(){
	
	var kodeorder 		= $('#cborder').val();
	
	$.ajax({
		type	: "GET", 
		url		: "pages/print/lintasspk.php",
		data	: "kodeorder="+kodeorder,
		dataType: "json",
		success	: function(data){
			alert(kodeorder);
			alert(data.result);
			if(data.result==1){
				window.location.assign(data.hlink);
			}
		}	
	});	
}
$('#btnok').click(function(){
	report();
});
function tampil_data(){		
	$.ajax({
		type		: "POST",
		url			: "pages/orderproduk/cari.php",
		dataType	: "json",
		success		: function(data){
			
			if(data.ada>0){
				$("#txttglorder").val('');
				$("#cbocustomer").val('');
				$("#cbobarang").val('');
				$("#txtjml").val('');
				$("#txtbiaya").val('');
			}
		}
	});
}