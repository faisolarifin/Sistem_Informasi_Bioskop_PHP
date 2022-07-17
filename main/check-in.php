<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="atensi">
    <!-- pemberitahuan -->
  </div><br>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        	<div class="card">
        		<div class="card-body" style="text-align:center;">
				    <video id="preview" height="300"></video>
        		</div>
        	</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <!-- card -->
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">#</th>
                  <th>ID Pesan</th>
                  <th>Nama Customer</th>
                  <th>Judul Film</th>
                  <th>Studio</th>
                  <th>Kursi</th>
                </tr>
                </thead>
                <tbody id="data"> </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>

<script>
    let scanner = new Instascan.Scanner(
        {
            video: document.getElementById('preview')
        }
    );
    scanner.addListener('scan', function(content) {
        $.ajax({
  			type: 'GET',
  			url: "../modul/ambil-tiket.php",
  			data: 'qr='+ content,
  			success: function(respons) {
  				let row = JSON.parse(respons);
          console.log(row);
          if (row.length != 0){
            row = row[0];
            if (row.status == 0){
      				let $html_data = "<tr>\
      						<td>1.</td>\
      						<td>"+row.id_pesan+"</td>\
      						<td>"+row.nama+"</td>\
      						<td>"+row.judul_film+"</td>\
      						<td>"+row.nama_studio+"</td>\
      						<td>"+row.nama_kursi+"</td>\
      				";
      				$('#data').html($html_data);
      				$html_atensi = "<div class='alert alert-success alert-dismissible'>\
                              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>\
                              <h5><i class='icon fas fa-exclamation-triangle'></i> Notifikasi!</h5>\
                              Tiket terdaftar, dengan ID pesan "+ row.id_pesan +"\
                            </div>";
              $('.atensi').html($html_atensi);
            } else {
              $html_atensi = "<div class='alert alert-warning alert-dismissible'>\
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>\
                            <h5><i class='icon fas fa-exclamation-triangle'></i> Notifikasi!</h5>\
                            Tiket telah digunakan sebelumnya!\
                          </div>";
              $('#data').html('');
              $('.atensi').html($html_atensi);
            }
          } else {
            $html_atensi = "<div class='alert alert-danger alert-dismissible'>\
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>\
                            <h5><i class='icon fas fa-exclamation-triangle'></i> Notifikasi!</h5>\
                            Tiket tidak ditemukan atau telah expied!\
                          </div>";
            $('#data').html('');
            $('.atensi').html($html_atensi);
          }
  			}
  		});
    });
    Instascan.Camera.getCameras().then(cameras => 
    {
        if(cameras.length > 0){
            scanner.start(cameras[0]);
        } else {
            console.error("Não existe câmera no dispositivo!");
        }
    });
</script>