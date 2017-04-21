$(document).ready(function() {
	tampildata();
	
});	


function tampildata(){
	$.ajax({
		type	: "POST",		
		url		: "pages/print/datakirim.php",
		dataType : "json",
		success	: function(data){
			$("#kodekirim").html(data.kodekirim);
			$("#kendaraan").html(data.kendaraan);
			$("#nopol").html(data.nopol);
			$("#barang").html(data.barang);
			$("#jml").html(data.jml);
			$("#pabrik").html(data.pabrik);
			$("#alamat").html(data.alamat);
			$("#email").html(data.email);
			$("#web").html(data.web);
			$("#customer").html(data.customer);
			$("#tujuan").html(data.tujuan);
			$("#ket").html(data.ket);
		}
	});
}	

