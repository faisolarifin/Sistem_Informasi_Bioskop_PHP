
$(function(){

	$('.select-film').on('change', function(){
		$.ajax({
			type: 'GET',
			url: "./modul/detail-jadwal.php",
			data: 'id='+$(this).val(),
			success: function(respons) {
				let row = JSON.parse(respons)
				if (row.length != 0) {
					row = row[0]
					let detail = "<tr>\
	                    <th rowspan='5' style='text-align:center;width:190px;'><img src='./upload/images/"+ row.gambar +"' alt='poster' width='180' height='150'></th>\
	                  </tr>\
	                  <tr>\
	                    <th width='80'>Studio :</th>\
	                    <td>"+ row.nama_studio +" [ "+ row.jenis +"]</td>\
	                  </tr>\
	                  <tr>\
	                    <th>Judul :</th>\
	                    <td>"+ row.judul_film +"</td>\
	                  </tr>\
	                  <tr>\
	                    <th>Durasi :</th>\
	                    <td>"+ row.durasi +"</td>\
	                  </tr>\
	                  <tr>\
	                    <th>Tanggal:</th>\
	                    <td>"+ row.tanggal +"</td>\
	                  </tr>\
	                  <tr>\
	                    <th>Jam Tayang</th>\
	                    <th>Selesai</th>\
	                    <th>Jumlah Kursi</th>\
	                  </tr>\
	                  <tr>\
	                    <td>"+ row.jam_mulai +"</td>\
	                    <td>"+ row.jam_selesai +"</td>\
	                    <td>"+ row.kursi +" Kursi</td>\
	                  </tr>\
	                  <tr>\
	                    <td colspan='3'>"+ row.deskripsi +"</td>\
	                  </tr>";
	                $('#detail').html(detail);
	                $('#Jumlah').val(row.kursi);
	                $('#Jumlah').attr('max',row.kursi);
	            } else {
	            	$('#detail').html('');
	            }
				
			}
		});
	});
	$('.masuk-film').on('change', function(){

		$.ajax({
			type: 'GET',
			url: "./set-booking.php",
			data: 'req=film&id='+$(this).val(),
			success: function(respons) {
				let row = JSON.parse(respons)
				if (row.length != 0) {
					row = row[0]
					let detail = "<tr>\
	                    <th rowspan='4' style='text-align:center;width:190px;'><img src='../upload/images/"+ row.gambar +"' alt='poster' width='180' height='150'></th>\
	                  </tr>\
	                  <tr>\
	                    <th width='80'>Judul :</th>\
	                    <td>"+ row.judul_film +"</td>\
	                  </tr>\
	                  <tr>\
	                    <th>Jenis :</th>\
	                    <td>"+ row.jns_film +"</td>\
	                  </tr>\
	                  <tr>\
	                    <th>Durasi :</th>\
	                    <td>"+ row.durasi +"</td>\
	                  </tr>\
	                  <tr>\
	                    <td colspan='3'>"+ row.deskripsi +"</td>\
	                  </tr><td colspan='3' id='harga'></td></tr>";

	                $('#film-detail').html(detail);
	            } else {
	            	$('#film-detail').html('');
	            }
				
			}
		});
	});
	$('#Tanggal').on('change', function(){
		$.ajax({
			type: 'GET',
			url: "./set-booking.php",
			data: 'req=jadwal&film='+$('#Film').val()+'&tipe='+$('#Tipe').val()+'&tanggal='+$(this).val(),
			success: function(respons) {
				let row = JSON.parse(respons)
				let detail = "<div class='form-group'>\
                      <label for='Tanggal'>Jadwal</label><div>";
                if (row.length > 0){
                	for (let i=0;i<row.length;i++){
					detail += "<input type='radio' name='tiket' class='jdw' id='"+row[i].id_tiket+"' value='"+row[i].id_tiket+"'> <label for='"+row[i].id_tiket+"'>"+row[i].jam_mulai.substr(0,5)+" - "+row[i].jam_selesai.substr(0,5)+" </label> ";
					}
					detail += "</div><script src='../dist/js/kursi.js'></script></div>";
		            $('#set-jadwal').html(detail);
                }else{
                	detail += "<center>Jadwal Kosong !</center>";
		            $('#set-jadwal').html(detail);
                }	
			}
		});
	});

	$('#Studio').on('change', function(){
      $.ajax({
      	type : 'GET',
      	url : '../modul/seat-count.php',
      	data : 'id_studio='+$(this).val(),
      	success : function(respons) {
      		let row = JSON.parse(respons)[0];
      		$('#JumlahTkt').val(row.banyak);
      		$('#JumlahTkt').attr('max', row.banyak);
      	}
      });
    });

});
