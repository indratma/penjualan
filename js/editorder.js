$(document).ready(function() {
	isi_cboarmada();
	isi_cbocustomer();
	isi_cbokotaasal();
	isi_cbokotatujuan();
	isi_cbomarketing();
	tampil_data();
});						   

$(function() {
	$( "#txttglmuat" ).datepicker({
		dateFormat:"dd-mm-yy",
		changeMonth:true,
		changeYear:true
	}); 

});		

$(function() {
	$( "#txttglbongkar" ).datepicker({
		dateFormat:"dd-mm-yy",
		changeMonth:true,
		changeYear:true
	}); 

});		


function isi_cboarmada(){
	$.ajax({
		type: 'POST', 
		url: 'pages/inputorder/tampilkan_armada.php',
		success: function(response) {
			$('#cboarmada').html(response); 
		}
	});	
}

function isi_cbocustomer(){
	$.ajax({
		type: 'POST', 
		url: 'pages/inputorder/tampilkan_customer.php',
		success: function(response) {
			$('#cbocustomer').html(response); 
		}
	});	
}

function isi_cbokotaasal(){
	$.ajax({
		type: 'POST', 
		url: 'pages/inputorder/tampilkan_kota.php',
		success: function(response) {
			$('#cbokotaasal').html(response); 
		}
	});	
}

function isi_cbokotatujuan(){
	$.ajax({
		type: 'POST', 
		url: 'pages/inputorder/tampilkan_kota.php',
		success: function(response) {
			$('#cbokotatujuan').html(response); 
		}
	});	
}

function isi_cbomarketing(){
	$.ajax({
		type: 'POST', 
		url: 'pages/inputorder/tampilkan_karyawan.php',
		success: function(response) {
			$('#cbomarketing').html(response); 
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
		url		: "pages/inputorder/caricstmr.php",
		data	: "kdcustomer="+kdcustomer,
		dataType: "json",
		success	: function(data){
			$('#txtperson').val(data.nama_customer);
			$('#alamat').val(data.alamat);
			$('#txttelp').val(data.telp);
			 
		}	
	});
}

$('#btnconfirm').click(function(){
	var tglmuat		 	= $("#txttglmuat").val();
	var tglx			= tglmuat.substring(0,2);
	var blnx			= tglmuat.substring(3,5);
	var thnx			= tglmuat.substring(6);
	var tglmuatx	 	= thnx+blnx+tglx;
	var kodearmada 	 	= $("#cboarmada").val();
	var kodecustomer 	= $("#cbocustomer").val();
	var kotaasal		= $("#cbokotaasal").val();
	var kotatujuan		= $("#cbokotatujuan").val();
	var tglbongkar	 	= $("#txttglbongkar").val();
	var tglx			= tglbongkar.substring(0,2);
	var blnx			= tglbongkar.substring(3,5);
	var thnx			= tglbongkar.substring(6);
	var tglbongkarx	 	= thnx+blnx+tglx;	
	var marketing		= $("#cbomarketing").val();
	var muatan			= $("#txtnamabrg").val();
	var jml				= $("#txtjml").val();
	var kodesatuan		= $("#cbosatuan").val();
	var biaya			= $("#txtbiaya").val();
	var sistemsewa		= $("#cbopersatuan").val();
	var marketing		= $("#cbomarketing").val();
		
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
	
	today = yyyy+mm+dd;
*/	
	if(kodearmada.length==0){
		$("#warningx").text('Armada belum dipilih !');
		return false;
	}
	if(tglmuat.length==0){
		$("#warningx").text('Tgl Muat masih kosong !');
		return false;
/*	}else{
		if(tglmuatx<today){
			$("#warningx").text('Tgl Muat tidak boleh kurang dari tgl skg !');
			return false;
		}
*/	}	
	if(kotaasal.length==0){
		$("#warningx").text('Asal berangkat belum dipilih !');
		return false;
	}	
	if(kotatujuan.length==0){
		$("#warningx").text('Kota tujuan masih kosong !');
		return false;
	}	
	if(tglbongkar.length==0){
		$("#warningx").text('Tgl Bongkar masih kosong !');
		return false;
/*	}else{
		if(tglbongkarx<tglmuatx){
			$("#warningx").text('Tgl Bongkar tidak boleh kurang dari Tgl Muat !');
			return false;
		}
*/	}
	if(kodecustomer.length==0){
		$("#warningx").text('Nama Customer belum dipilih !');
		return false;
	}
	if(muatan.length==0){
		$("#warningx").text('Nama Barang masih kosong !');
		return false;
	}
	if(jml<0 && kodesatuan.length==0){
		$("#warningx").text('Satuan berat belum dipilih !');
		return false;
	}	
	
	if(biaya.length==0){
		$("#warningx").text('Biaya Sewa tidak boleh kosong !');
		return false;
	}
	
	if(sistemsewa.length==0){
		$("#warningx").text('Sistem Sewa belum dipilih !');
		return false;
	}	
	
	$("#confirm-modal").modal('toggle');
	$("#confirm-modal").modal('show');
	
});

function simpandata(){	

	var tglmuat		 	= $("#txttglmuat").val();
	var kodearmada 	 	= $("#cboarmada").val();
	var kodecustomer 	= $("#cbocustomer").val();
	var kotaasal		= $("#cbokotaasal").val();
	var kotatujuan		= $("#cbokotatujuan").val();
	var tglbongkar	 	= $("#txttglbongkar").val();
	var marketing		= $("#cbomarketing").val();
	var muatan			= $("#txtnamabrg").val();
	var jml				= $("#txtjml").val();
	var kodesatuan		= $("#cbosatuan").val();
	var biaya			= $("#txtbiaya").val();
	var sistemsewa		= $("#cbopersatuan").val();
	var marketing		= $("#cbomarketing").val();
	var ket				= $("#txtket").val();
		
	$.ajax({
		type	: "POST", 
		url		: "pages/inputorder/update.php",
		data	: "tglmuat="+tglmuat+
				"&kodearmada="+kodearmada+
				"&kodecustomer="+kodecustomer+					
				"&kotaasal="+kotaasal+
				"&kotatujuan="+kotatujuan+
				"&tglbongkar="+tglbongkar+
				"&muatan="+muatan+
				"&jml="+jml+
				"&kodesatuan="+kodesatuan+
				"&biaya="+biaya+
				"&sistemsewa="+sistemsewa+
				"&marketing="+marketing+
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
		url			: "pages/inputorder/cari.php",
		dataType	: "json",
		success		: function(data){
			
			if(data.ada>0){
				$("#cboarmada").select2('val',data.armada);
				$("#txttglmuat").val(data.tglmuat);
				$("#cbokotaasal").select2('val',data.kotaasal);				
				$("#cbokotatujuan").select2('val',data.kotatujuan);
				$("#txttglbongkar").val(data.tglsampai);				
				$("#cbocustomer").select2('val',data.customer);
				$("#txtnamabrg").val(data.namabrg);
				$("#txtjml").val(data.jml);
				$("#cbosatuan").val(data.kodesatuan);
				$("#txtbiaya").val(data.biayasewa);
				$("#cbopersatuan").val(data.sistemsewa);
				$("#cbomarketing").select2('val',data.marketing);
				$('#txtperson').val(data.nama_customer);
				$('#alamat').val(data.alamat);
				$('#txttelp').val(data.telp);
				$('#txtket').val(data.ket);
			}
		}
	});
}