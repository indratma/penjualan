$(document).ready(function() {						   
	get_value();	
});						   

function get_value(){
	$.ajax({
		type	: "GET",		
		url		: "pages/dashboard/tampildata.php",
		data	: "kode=",
		success	: function(data){
			$("#nilaidsb").html(data);
		}
	});
}	


