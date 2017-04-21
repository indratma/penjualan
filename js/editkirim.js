$(document).ready(function() {	
	isi_cborder();
	isi_cbopers();
	tampil_data();
});						   

$(function() { 
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });
});

$(function() {
	$( "#txttglkirim" ).datepicker({
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
function isi_cborder(){
	$.ajax({
		type: 'POST', 
		url: 'pages/kirimbarang/tampilkan_order.php',
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
		url		: "pages/kirimbarang/cariorder.php",
		data	: "kodeorder="+kodeorder,
		dataType: "json",
		success	: function(data){
			$('#txtpers').val(data.perusahaan);
			$('#txtalamat').val(data.alamat);
			 
		}	
	});
}
function isi_cbopers(){
	$.ajax({
		type: 'POST', 
		url: 'pages/kirimbarang/tampilkan_perusahaan.php',
		success: function(response) {
			$('#cbopers').html(response); 
		}
	});	
}
$('#btnconfirm').click(function(){
	
	var tglkirim		= $("#txttglkirim").val();
	var tglx			= tglkirim.substring(0,2);
	var blnx			= tglkirim.substring(3,5);
	var thnx			= tglkirim.substring(6);
	var tglkirimtx	 	= tglx+blnx+thnx;
	var kodeorder	 	= $("#cborder").val();
	var kodeperusahaan	= $("#cbopers").val();
	var jml				= $("#txtjml").val();
	var kendaraan		= $("#txtkend").val();
	var nopol			= $("#txtpol").val();
	var ket				= $("#txtket").val();
	
		
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
		$("#warningx").text('Nomor PO belum dipilih !');
		return false;
	}
	if(kodeperusahaan.length==0){
		$("#warningx").text('Nama Pabrik belum dipilih !');
		return false;
	}
	if(tglkirim.length==0){
		$("#warningx").text('Tanggal Pengiriman masih kosong !');
		return false;
	}	
	if(jml.length==0){
		$("#warningx").text('Jumlah Pengiriman masih kosong !');
		return false;
/*	}else{
		if(tglmuatx<today){
			$("#warningx").text('Tgl Muat tidak boleh kurang dari tgl skg !');
			return false;
		}
*/	}	
	if(kendaraan.length==0){
		$("#warningx").text('Nama Kendaraan tidak boleh kosong !');
		return false;
	}	
	
	if(nopol.length==0){
		$("#warningx").text('Nomor Polisi tidak boleh kosong !');
		return false;
	}
	
	
	$("#confirm-modal").modal('toggle');
	$("#confirm-modal").modal('show');
	
});

function simpandata(){	
	var tglkirim		= $("#txttglkirim").val();
	var kodeorder	 	= $("#cborder").val();
	var kodeperusahaan	= $("#cbopers").val();
	var kendaraan		= $("#txtkend").val();
	var jml				= $("#txtjml").val();
	var nopol			= $("#txtpol").val();
	var ket				= $("#txtket").val();
							
	$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/simpan.php",
		data	: "tglkirim="+tglkirim+
				"&kodeorder="+kodeorder+					
				"&kodeperusahaan="+kodeperusahaan+
				"&kendaraan="+kendaraan+
				"&jml="+jml+
				"&nopol="+nopol+
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

/*function report(){
	
	var kodeorder 		= $('#cborder').val();

	$.ajax({
		type	: "GET", 
		url		: "pages/print/lintassj.php",
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
}*/
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