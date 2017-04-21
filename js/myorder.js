$(document).ready(function() {	
	isi_cbocustomer();
	isi_cbobarang();
	tampil_data();
});						   

$(function() {
			$('#txtbiaya').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
});

$(function() {
	$( "#txttglorder" ).datepicker({
		dateFormat:'dd-mm-yy',
		keyboardNavigation: false,
		todayBtn: "linked",
		todayHighlight: true,
		autoclose: true,
		changeMonth:true,
		changeYear:true
			}); 
});		
$(function() {   
   $(".select2_demo_3").select2({
                placeholder: "Silahkan Pilih",
                allowClear: true
            });
	});
function isi_cbocustomer(){
	$.ajax({
		type: 'POST', 
		url: 'pages/orderproduk/tampilkan_customer.php',
		success: function(response) {
			$('#cbocustomer').html(response); 
		}
	});	
}

$('#cbocustomer').change(function(){
	cari_customer();
});

function cari_customer(){
	var kdcustomer 	= $("#cbocustomer").val();
	$.ajax({
		type	: "POST", 
		url		: "pages/orderproduk/caricstmr.php",
		data	: "kdcustomer="+kdcustomer,
		dataType: "json",
		success	: function(data){
			$('#txtperson').val(data.nama_customer);
			$('#alamat').val(data.alamat);
			$('#txttelp').val(data.telp);
			 
		}	
	});
}

function isi_cbobarang(){
	$.ajax({
		type: 'POST', 
		url: 'pages/orderproduk/tampilkan_barang.php',
		success: function(response) {
			$('#cbobarang').html(response); 
		}
	});	
}


$('#cbobarang').change(function(){
	cari_barang();
});

function cari_barang(){
	var kdbarang 	= $("#cbobarang").val();
	$.ajax({
		type	: "POST", 
		url		: "pages/orderproduk/caribarang.php",
		data	: "kdbarang="+kdbarang,
		dataType: "json",
		success	: function(data){
			//$('#mesh').val(data.mesh); 
		}	
	});
}


$('#btnconfirm').click(function(){
	
	var tglorder		= $("#txttglorder").val();
	var tglx			= tglorder.substring(0,2);
	var blnx			= tglorder.substring(3,5);
	var thnx			= tglorder.substring(6);
	var tglordertx	 	= tglx+blnx+thnx;
	var kodecustomer 	= $("#cbocustomer").val();
	var kodebarang		= $("#cbobarang").val();
	var jml				= $("#txtjml").val();
	var tbiaya			= $("#txtbiaya").val();
	
		
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
	
	
	if(tglorder.length==0){
		$("#warningx").text('Tgl Order masih kosong !');
		return false;
/*	}else{
		if(tglmuatx<today){
			$("#warningx").text('Tgl Muat tidak boleh kurang dari tgl skg !');
			return false;
		}
*/	}	
	if(kodecustomer.length==0){
		$("#warningx").text('Nama Customer belum dipilih !');
		return false;
	}
	if(kodebarang.length==0){
		$("#warningx").text('Nama Barang masih kosong !');
		return false;
	}
	if(jml.length==0){
		$("#warningx").text('Jumlah Orderan tidak boleh kosong !');
		return false;
	}	
	
	if(tbiaya.length==0){
		$("#warningx").text('Total Harga tidak boleh kosong !');
		return false;
	}
	
	
	$("#confirm-modal").modal('toggle');
	$("#confirm-modal").modal('show');
	
});

function simpandata(){	
	var tglorder		 = $("#txttglorder").val();
	var kodecustomer 	= $("#cbocustomer").val();
	var kodebarang		= $("#cbobarang").val();
	var jml				= $("#txtjml").val();
	var tbiaya			= $("#txtbiaya").val();
	var ket				= $("#txtket").val();
							
	$.ajax({
		type	: "POST", 
		url		: "pages/orderproduk/simpan.php",
		data	: "tglorder="+tglorder+
				"&kodecustomer="+kodecustomer+					
				"&kodebarang="+kodebarang+
				"&jml="+jml+
				"&tbiaya="+tbiaya+
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

$('#btnok').click(function(){
	location.reload();
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