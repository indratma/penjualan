$(document).ready(function() {	
	isi_cbopelaksana();
	isi_cboperusahaan();
	tampillistbrg();
	tampillistbrgtmp();
	//setbtn
});		

$("#cboperusahaan").change(function() {
	isi_kodepermintaan();
	cleartemp();
});

$("#cbopermintaan").change(function() {
	var tipe = $("#tipe").val();
	
	if(tipe == 1) {
		tampillistbrg();
	} else {
		tampillistbrggnti();
	}
//	$('input[name=rad]').iCheck('uncheck');
});

$("#addbarang").click(function() {
	addbarang();
});

$('input[name=rad]').on('ifChecked', function(event){
 if($(this).val() == 1) {
	 $("#tipe").val('1');
	 isi_kodepermintaan();
 } else if ($(this).val() == 2) {
	$("#tipe").val('2');
	isi_kodepermintaan();
 }
});

function cleartemp() {
	$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/cleartemp.php",
		timeout	: 3000,
		success	: function(data){
			tampillistbrgtmp();
		}
	});
}

function isi_cboperusahaan() {
	$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/tampilkan_perusahaan.php",
		timeout	: 3000,
		success	: function(data){
			$("#cboperusahaan").html(data);
		}
	});
}

function updatejml(kdbrg, permintaan){
	$("#updjml-modal").modal('toggle');
	$("#updjml-modal").modal('show');	
	$("#txtjml").val('');
	$('#inputwarning_updjml').hide();
	$("#lblkodebrg_updjml").text(kdbrg);
	$("#lblpermintaan_updjml").text(permintaan);
	$("#txtjml").focus();
}

$("#btnupdate_updjml").click(function(){									   
	var kodebrg		= $("#lblkodebrg_updjml").text();
	var permintaan	= $("#lblpermintaan_updjml").text();
	var jml			= $("#txtjml").val();	

	var batalkan = false;
	
	if(jml==0){
		$("#inputwarning_updjml").show();
		$("#inputwarning_updjml").text('Jumlah barang tidak valid.');
		$("#txtjml").focus();
		var batalkan = true;
	}
	
	if(batalkan==false){
		$.ajax({
			type	: "POST",		
			url		: "pages/kirimbarang/editjml.php",
			data	: "kodebrg="+kodebrg+
						"&permintaan="+permintaan+
						"&jml="+jml,
			dataType: "json",			
			success	: function(data){
				if(data.sukses==0){
					$('#inputwarning_updjml').show();
					$('#inputwarning_updjml').text(data.pesan);
				}else{
					$("#updjml-modal").modal('hide');
					tampillistbrgtmp();
				}				
			}
		});
	}
});

function tampillistbrg(){
	var permintaan = $("#cbopermintaan").val();
	$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/tampillistbrg.php",
		data 	: "permintaan="+permintaan,
		timeout	: 3000,
		success	: function(data){
			$("#tblbrg").html(data);
		}
	});
}

function tampillistbrggnti(){
	var permintaan = $("#cbopermintaan").val();
	$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/tampillistbrggnti.php",
		data 	: "permintaan="+permintaan,
		timeout	: 3000,
		success	: function(data){
			$("#tblbrg").html(data);
		}
	});
}

function tampillistbrgtmp(){
	$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/tampillistbrgtmp.php",
		timeout	: 3000,
		success	: function(data){
			$("#tblbrgtmp").html(data);
		}
	});
}

function isi_kodepermintaan() {
	var kodeprshn = $("#cboperusahaan").val();
	var tipe = $("#tipe").val();
	$.ajax({
		type: 'POST', 
		url: 'pages/kirimbarang/tampilkan_permintaan.php',
		data: 'kodeprshn='+kodeprshn+
				'&type='+tipe,
		success: function(response) {
			$('#cbopermintaan').html(response); 
		}
	});		
}

function isi_cbopelaksana(){
	$.ajax({
		type: 'POST', 
		url: 'pages/kirimbarang/tampilkan_karyawan.php',
		success: function(response) {
			$('#cbopengirim').html(response); 
		}
	});		
}

function addbarang(){
	var permintaan = $("#cbopermintaan").val();
	var tipe = $("#tipe").val();
	
	if (tipe == 1) {
		$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/addbarang.php",
		data  	: "permintaan="+permintaan,
		success	: function(data){	
			tampillistbrg();
			tampillistbrgtmp();
		}	
	});
	} else if (tipe == 2) {
		$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/addbaranggnti.php",
		data  	: "permintaan="+permintaan,
		success	: function(data){	
			tampillistbrggnti();
			tampillistbrgtmp();
		}
	});
	}
}

function simpandata(){
	var kodeprshn	= $("#lblkodeprshn_confirm").text();
	var pengirim 	= $("#lblidsender_confirm").text();
	
	$.ajax({
		type	: "POST", 
		url		: "pages/kirimbarang/simpan.php",
		data	: "kodeprshn="+kodeprshn+
					"&pengirim="+pengirim,
		timeout	: 3000,
		beforeSend	: function(){		
			$("#overlayx").show();
			$("#loading-imgx").show();			
		},
		success	: function(data){
			var tipe = $("#tipe").val();
			$("#overlayx").hide();
			$("#loading-imgx").hide();			
			$("#confirm-modal").modal('hide');
			$("#info-modal").modal('toggle');
			$("#info-modal").modal('show');
			$("#infone").html(data);
			$("#cboperusahaan").val('');
			$("#cbopengirim").val('');
			$("#cbopermintaan").val('');
			if(tipe == 1) {
				tampillistbrg();
			} else if (tipe == 2) {
				tampillistbrggnti();
			}
			tampillistbrgtmp();
		}	
	});		
}		

$('#btnconfirm').click(function(){
	$("#lblwarning_save").text('');	
	
	$.ajax({
		type	: "POST",
		url		: "pages/kirimbarang/getdatacount.php",
		dataType: "json",
		success	: function(data){	
			var pengirim 	= $("#cbopengirim").val();
			var kodeprshn 	= $("#cboperusahaan").val();
			
			if(pengirim.length>0 && data.jmlrec>0){
				$("#confirm-modal").modal('toggle');
				$("#confirm-modal").modal('show');	
				$("#lblidsender_confirm").text(pengirim);
				$("#lblkodeprshn_confirm").text(kodeprshn);
			}else{
				if(pengirim.length==0){
					$("#lblwarning_save").text('Nama Pengirim belum dipilih.');
					return false;
				}
				
				if(data.jmlrec==0){
					$("#lblwarning_save").text('Data barang masih kosong.');
					return false;
				}
			}
		}
	});
});

$('#btnsave').click(function(){
	simpandata();
	$('input[name=rad]').iCheck('uncheck');	
});
	
function del(kodebrg,permintaan,pembelian){
	
	$.ajax({
		type	: "POST",
		url		: "pages/kirimbarang/hapus.php",
		data	: "kodebrg="+kodebrg+
					"&permintaan="+permintaan+
					"&pembelian="+pembelian,
		success	: function(data){
			var tipe = $("#tipe").val();
			if (tipe == 1) {
				tampillistbrg();
			} else if (tipe == 2) {
				tampillistbrggnti();
			}
			tampillistbrgtmp();
		}
	});
}