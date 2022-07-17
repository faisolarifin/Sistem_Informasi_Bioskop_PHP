$('.jdw').on('click', function(){
	$.ajax({
		type: 'GET',
		url: "./set-booking.php",
		data: 'req=kursi&jadwal='+$(this).val(),
		success: function(respons) {
			let row = JSON.parse(respons)
			let detail = "<div class='form-group'>\
                      <label for='Tanggal'>Kursi</label><div>";
            if (row.length > 0){
            	for (let i=0;i<row.length;i++){
				detail += "<input type='checkbox' name='kursi[]' id='"+row[i].id_kursi+"' value='"+row[i].id_kursi+"'> <label for='"+row[i].id_kursi+"'>"+row[i].nama_kursi+"</label> ";
				}
				detail += "</div></div>";
	            $('#set-kursi').html(detail);
	            $('#harga').html("<span class='btn btn-success'><b>Harga : Rp. "+ row[0].harga +" </b></span>");
            }else{
            	detail += "<center>Kursi Habis !</center></div></div>";
	            $('#set-kursi').html(detail);
            }
			
		}
	});
});