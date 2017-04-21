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
		url: 'pages/orderproduk/tampilkan_order.php',
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
			$('#tglorder').val(data.tglorder);
			$('#txtbarang').val(data.namabarang);
			$('#txtjml').val(data.jumlah);
			$('#txtpers').val(data.perusahaan);
			$('#txtalamat').val(data.alamat);
			 
		}	
	});
}

/*function isi_cborder(){
	$.ajax({
		type: 'POST', 
		url: 'pages/orderproduk/tampilkan_order.php',
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
			$('#tglorder').val(data.tglorder);
			$('#txtbarang').val(data.namabarang);
			$('#txtjml').val(data.jumlah);
			$('#txtpers').val(data.perusahaan);
			$('#txtalamat').val(data.alamat);
			 
		}	
	});
}
*/

$('#btnconfirm').click(function(){
	
	var kodeorder 	= $("#cborder").val();
	
	
		
/*	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	
	
	if(dd<10) {
		dd='0'+dd
	} 
	
	if(mm<10) {
		mm='0'+mm
	} 
	
	today = dd+mm+yyyy;
*/	/*
	alert(tglmuatx);
	alert(dd);
	alert(mm);
	alert(yyyy);
	alert(today);
	*/
	
	
	
	if(kodeorder.length==0){
		$("#warningx").text('PO Belum Di Pilih !');
		return false;
	}
	
	
	
	$("#confirm-modal").modal('toggle');
	$("#confirm-modal").modal('show');
	
});

function simpandata(){	
	var kodeorder		= $("#cborder").val();
							
	$.ajax({
		type	: "POST", 
		url		: "pages/orderproduk/simpanspm.php",
		data	: "kodeorder="+kodeorder,
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
		url		: "pages/print/lintasspm.php",
		data	: "kodeorder="+kodeorder,
		dataType: "json",
		success	: function(data){
			//alert(kodeorder);
			//alert(data.result);
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
				$("#cborder").val('');
			}
		}
	});
}