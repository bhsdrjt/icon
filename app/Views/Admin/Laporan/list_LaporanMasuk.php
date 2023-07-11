<?= $this->extend('Admin/Layout/templateAdmin'); ?>

<?= $this->section('content'); ?>
<style>
	table {
    border-collapse:separate;
    border:solid black 1px;
    border-radius:6px;
	border-color: #D2D2D2;
}

td, th {
	border-left:solid black 1px;
    border-top:solid black 1px;
	border-color: #D2D2D2;
}

th {
    /* background-color: blue; */
    border-top: none;
}

td:first-child, th:first-child {
     border-left: none;
}
</style>

<?php 
function nBulan($bln, $short = FALSE)
{
	$bulan = ($short == TRUE) ?
		array('', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sep', 'Okt', 'Nov', 'Des') :
		array(
			'', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
			'Oktober', 'November', 'Desember'
		);
	return $bulan[(int)$bln];
}
 ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- <div class="comtainer">
        <div class="row">
            <h3>Ini Halaman Admin</h3>
        </div>
    </div> -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3text-gray-800">Laporan Pengaduan</h1>
        <div class="card-header py-3">
            <a href="#" onclick="exportsData()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> EXPORT EXCEL </a>
            <!-- <a href="<?= base_url('Laporan/ExcelLaporan'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> EXPORT EXCEL</a> -->
        </div>

    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- 

   Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
				<div class="panel-body panel-body-border" >
				<form id="" class="bucket-form" method="get">
					<div class="row">
						<!-- <div class="col-xs-3 col-sm-3 col-sm-2">
							<div class="form-group">
								<label>Jenis Gangguan</label>
								<select name="kd_dealer" id="kd_dealer" class="form-control" required="true">
									<option value="">- Pilih Dealer -</option>
									
								</select>
							</div>
						</div> -->

						<div class="col-xs-3 col-sm-3 col-md-2">
							<div class="form-group">
								<label>Bulan</label>
								<select class="form-control " id="bulan" name="b">
									<option disabled value="">- Pilih Bulan -</option>
									<?php for ($n = 1; $n <= 12; $n++) {
										$n = str_pad($n, 2, '0', STR_PAD_LEFT);
										$aktif = ($bulan == $n) ? "selected" : "";
										$aktif = (date("m") == $n && $bulan == '') ? "selected" : $aktif;
										echo "<option value=" . $n . " $aktif>" . nBulan($n) . "</option>";
									} ?>
												
								</select>
							</div>
						</div>

						<div class="col-xs-3 col-sm-2 col-md-2">
							<div class="form-group">
								<label>Tahun</label>
								<select class="form-control" id="tahun" name="t">
									<option disabled value="">- Pilih Tahun -</option>
									<?php if ($tahun > 0) {
										echo "<option value='" . $tahun . "' selected>" . $tahun . "</option>";
									} ?>
									<option value="<?php echo date("Y") - 1; ?>"><?php echo date("Y") - 1; ?></option>
									<option value="<?php echo date("Y") - 2; ?>"><?php echo date("Y") - 2; ?></option>
								</select>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-2">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" id="status" name="status">
									<option disabled value="">- Pilih Tahun -</option>
									<option value="0">  Belum Ditangani </option>
									<option value="1">  Ditangani  </option>
									<option value="2">  Selesai </option>
								</select>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-2">
							<div class="form-group">
								<label>Jenis Laporan</label>
								<select class="form-control" id="jenis" name="jenis">
									<option disabled value="">- Pilih Tahun -</option>
									<option value="0">  Laporan Gangguan </option>
									<option value="1">  Perubahan Bandwith  </option>
								</select>
							</div>
						</div>

						<div class="col-xs-6 col-sm-4 col-md-2">
							<div class="form-group left pull-right"><br>
								<a class="btn btn-info" id="preview_btn" onclick='loadData();' name="preview_btn" role="button"><i class="fa fa-search"></i> Search</a>
							</div>
						</div>
					</div>
            </div>
        </div>
    </div>
	
	<div class="col-lg-12 padding-left-right-10">
		<div class="panel panel-default">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-stripped" id="listTable">
					<thead style="background-color: white;">
						<tr>
							<th class="text-center table-nowarp" style="width:3%">No.</th>
							<th class="text-center table-nowarp" style="width:10%">NO Laporan</th>
							<th class="text-center table-nowarp">Pelapor</th>
							<th class="text-center table-nowarp">Keterangan</th>
							<th class="text-center table-nowarp">Jenis</th>
							<th class="text-center table-nowarp">Waktu Lapor</th>
							<th class="text-center table-nowarp">Status Laporan</th>
							<th class="text-center table-nowarp">Aksi</th>
						</tr>
					</thead>
					<tbody id="">

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div id="mymodal1" class="modal fade bd-example-modal-lg" >
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Disposisi Laporan Masuk</h3>
				<button type="button" onclick="tutup()" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
			</div>
			<form id="contactForm" name="contact" role="form">
				<div class="modal-body">				
					<div class="form-group">
						<label id="name-id" for="name"> ID Laporan Masuk  : </label>
						<label id="id-laporan" for="name"></label>
					</div>
					<div class="form-row">
						<div class="col-md-7">
							<label  for="name"> Nama Teknisi</label>
							<input id="nama_teknisi" type="text" class="form-control" placeholder="Pilih Teknisi">
						</div>
						<div class="col-md-3">
							<label  for="name"> Peran</label>
							<!-- <input type="text" class="form-control" placeholder="Last name"> -->
							<select name="" class="form-select" id="peran">
								<option value=""> -- Pilih Peran --</option>
								<option value="Penanggung Jawab"> Penanggung Jawab</option>
								<option value="Teknisi"> Teknisi</option>
							</select>
						</div>
						<div class="col-md-2">
							<label  for="name"> </label>
							<a href="#" class="btn btn-success mt-4" id="tbl-tambah" onclick="tambah()" style="width: 40%; color: white">
     							<i class="fa fa-plus-circle">
								</i>
							</a>
						</div>
					</div>
					<br>
					<div class="form-row align-center" >
						<table style=" margin-left: auto; margin-right: auto; width:98%;" border="1" id="listTableAdd">
							<thead>
								<th  class="text-center" style="width: 60%;">Nama</th>
								<th class="text-center" style="width: 30%;">Peran</th>
								<th class="text-center" style="width: 10%;">Aksi</th>
							</thead>
							<tbody id='table-list'>
								
							</tbody>
						</table>
					</div>
				</div>				
				<div class="modal-footer">					
					<button type="button" id="btn-close" onclick="tutup()" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button"  id="btn-save" class="btn btn-success">Simpan</button>
					<!-- <input type="submit" class="btn btn-success" id="submit"> -->
				</div>
			</form>
		</div>
		</div>
	</div>


<div id="modalDetail" class="modal fade">  
    <div class="modal-dialog">  
         <div class="modal-content">  
              <div class="modal-header">  
                   <h4 class="modal-title">Detail Laporan</h4>  
              </div>  
              <div class="modal-body" id="detail_user">  
			  		<div class="form-group">
						<label id="name-id" for="name"> ID Laporan Masuk  : </label>
						<label id="detail_id" for="name"></label>
					</div>
			  		<div class="form-group">
						<label id="name-id" for="name"> Tanggal Lapor  : </label>
						<label id="detail_tanggal" for="name"></label>
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Pelapor : </label>
						<label id="detail_nama" for="name"></label>
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Alamat Pelapor : </label>
						<label id="detail_alamat" for="name"></label>
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Keterangan : </label>
						<label id="detail_keterangan" for="name"></label>
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Status : </label>
						<label id="detail_status" for="name"></label>
					</div>
              </div>  
              <div class="modal-footer">  
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
              </div>  
         </div>  
    </div>  
</div>

<div id="modal-perubahan-bandwith" class="modal fade">  
    <div class="modal-dialog">  
         <div class="modal-content">  
              <div class="modal-header">  
                   <h4 class="modal-title">Perubahan Bandwith</h4>  
              </div>  
              <div class="modal-body" id="detail_user">  
			  		<div class="form-group">
						<label id="name-id" for="name"> ID Pelanggan : </label>
						<input type="text" id="id_pelapor"  class="form-control" readonly>
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Perubahan Bandwith Menjadi  : </label>
						<input type="text" id="p_bandwith"  class="form-control" readonly>
					</div>
					<input type="hidden" id="id_laporan_hidden"  class="form-control" readonly>
              </div>  
              <div class="modal-footer">  
                   <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>   -->
				   <button type="button" id="btn-close-bandwith" onclick="tutupBandwith()" class="btn btn-danger" data-dismiss="modal">Close</button>
				   <button type="button"  id="btn-save-bandwith" onclick="simpanBancwith()" class="btn btn-success">Simpan</button>
              </div>  
         </div>  
    </div>  
</div>

	<script type="text/javascript" src="<?= base_url('/js/jquery-3.6.0.js'); ?>"></script>
	<!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="exponential.js"></script> -->
	
	<script type="text/javascript">
	$(document).ready(function (){
		loadData();
		// loadTeknisi()
	});

	$('#btn-save-bandwith').click(function() { 
		// var id_pelanggan = $('#id_pelapor').val();
		// var bandwith = $('#p_bandwith').val();
		// console.log(id_pelanggan);
		// console.log(bandwith);
		$("#btn-save-bandwith").html("<i class='fa fa-spinner fa-spin'></i> Loading");
        $("#btn-save-bandwith").addClass('disabled-action')
		$.ajax({
			url : '<?= base_url('/Laporan/simpan_perubahanBandwith'); ?>',
			type: 'POST',
            dataType: 'json',
			data : {
				'id_pelanggan' 	: $('#id_pelapor').val(),
				'bandwith': $('#p_bandwith').val(),
				'id_laporan': $('#id_laporan_hidden').val()
			},
			success : function(result){
                if (result.status === 'true') {
					swal("Berhasil!", result.message, "success");
                    $("#btn-close-bandwith").click();
					$("#btn-save-bandwith").html('Simpan')
                    $("#btn-save-bandwith").removeClass("disabled-action");
                    loadData()
                } else {
                    $("#btn-save-bandwith").html('Simpan')
                    $("#btn-save-bandwith").removeClass("disabled-action");
					swal("Gagal!", result.message, "error");
                }							
			}
		});	
	});

	$('#btn-save').click(function() {
		var datax = __detaildata(); 
		var id_laporan = $('#id-laporan').text();
		// console.log(datax)
		if(datax == "" || datax == null){
			sweetError('Error', 'Pilih Teknisi Dulu');
		}else{
			$("#btn-save").html("<i class='fa fa-spinner fa-spin'></i> Loading");
            $("#btn-save").addClass('disabled-action')
			$.ajax({
				url : '<?= base_url('/Laporan/simpanDisposisi'); ?>',
				type: 'POST',
                dataType: 'json',
				data : {
					'detail' 	: datax,
					'id_laporan': id_laporan,
					'jenis'		: "laporan",
				},
				success : function(result){
                    if (result.status === 'true') {
						swal("Berhasil!", result.message, "success");
                        $("#btn-close").click();
						$("#btn-save").html('Simpan')
                        $("#btn-save").removeClass("disabled-action");
                        loadData()
                    } else {
                        $("#btn-save").html('Simpan')
                        $("#btn-save").removeClass("disabled-action");
						swal("Gagal!", result.message, "error");
                    }							
				}
			});
		}
		
	});

	function tambah(){
		
		var nama = $('#nama_teknisi').val();
		var peran = $('#peran').val();
		if(nama == '' || peran == ''){
			swal("Inputan Salah!", "Nama dan Peran tidak boleh kosong!", "error");
			// alert('Nama dan Peran tidak boleh kosong');
		}else{
		var html = "";
			html += '<tr>';
			html += '<td>'+nama+'</td>';
			html += '<td>'+peran+'</td>';
			html += '<td><a href="#" class="btn btn-danger" onclick="hapus(this)"> 	<i class="fa fa-trash"></i></a></td>';
			html += '</tr>';
			$('#table-list').append(html);
			$('#inputpicker-2').val('');
			$('#inputpicker-2').text('');
			$('#peran').val('');
		}
	}

	function hapus(){

	}
	
	function __detaildata(){
		var jmlrow = 0;
		var datax = [];
        jmlrow = $('#listTableAdd > tbody > tr').length;
		// alert(jmlrow);
		for (i = 0; i < jmlrow; i++){
			var exist = 0;
            exist = parseInt($('#listTableAdd > tbody > tr:eq(' + i + ') > td:eq(2)').text());
			if (isNaN(exist) || exist == 0) {
                datax.push({
					'nama' : $('#listTableAdd > tbody > tr:eq('+i+') > td:eq(0)').text(),
					'peran' : $('#listTableAdd > tbody > tr:eq('+i+') > td:eq(1)').text()
				});
			}
		}
		return datax;
	}

	function tutup(){
		$('#id-laporan').text();
		$('#listTableAdd > tbody ').empty();
		$('#mymodal1').modal('hide');
	}
	function tutupBandwith(){
		$('#modal-perubahan-bandwith').modal('hide');
		$('#id_pelapor').val();
		$('#p_bandwith').val();
		$('#id_laporan_hidden').val();
	}

	function loadTeknisi(){
		$('#nama_teknisi').inputpicker({
			url: '<?= base_url('/Teknisi/getTeknisi'); ?>',
			data:[ "NO_PEGAWAI", "NAMA" ],
			fieldText:'NAMA',
    		fieldValue:'NO_PEGAWAI',
		})
	}


	function loadData(){
		console.log($('#bulan').val())
		$.ajax({
			data : {
				'bulan' : $('#bulan').val(),
				'tahun' : $('#tahun').val(),
				'status' : $('#status').val(),
				'jenis' : $('#jenis').val()
			},
			type: 'POST',
			url: '<?= base_url('/Laporan/getLaporan'); ?>',
			typeData: 'html',
			success: function(result) {
				var d = $.parseJSON(result);
				console.log(d.message)
				var data = d.message
				var html = `<thead style="background-color: white;">
						<tr>
							<th class="text-center table-nowarp" style="width:3%">No.</th>
							<th class="text-center table-nowarp" style="width:10%">NO Laporan</th>
							<th class="text-center table-nowarp">Pelapor</th>
							<th class="text-center table-nowarp">Keterangan</th>
							<th class="text-center table-nowarp">Jenis</th>
							<th class="text-center table-nowarp">Waktu Lapor</th>
							<th class="text-center table-nowarp">Status Laporan</th>
							<th class="text-center table-nowarp">Aksi</th>
						</tr>
					</thead>`
				if(d.totaldata>0){
					var no = 1
					console.log(d.data)
					$.each(d.data, function(i, item) {
						var no_laporan = item.NO_LAPORAN
						if(item.STATUS == 0){
							var status = 'Belum Ditindaklanjuti';
						}else if(item.STATUS ==1){
							var status = 'Sudah Ditindaklanjuti';
						}else {
							var status = 'Selesai';
						}
							html += '<tr><td class="text-center">' + (no) + '</td>';
							html += '<td id="id_lap'+ no +'" class="text-center text-nowrap">'+(item.NO_LAPORAN)+'</i></a>'
							html += '<td class="text-center text-nowrap">' + item.NAMA + '</td>';
							html += '<td id="ket'+ no +'" class="text-left text-nowrap">' + item.KETERANGAN + '</td>';
							html += '<td class="text-left text-nowrap">' + item.JENIS + '</td>';
							html += '<td class="text-left text-nowrap">' + item.CREATED_TIME + '</td>';
							html += '<td class="text-left text-nowrap">' + status + '</td>';
							html += '<td class="text-center text-nowrap">';
							html += '<a href="#" onclick="bukaDetail(\'' + no + '\',\'' + item.NO_LAPORAN + '\')"><i class="fa fa-bars fa-2x " aria-hidden="true"></i></a>';
							if(item.STATUS ==0 && item.JENIS != 'Perubahan bandwith'){
								html += ' <a href="#" onclick="bukaModal(\'' + no + '\',\'' + item.ID + '\')"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a>';
							}
							if(item.JENIS == 'Perubahan bandwith' && item.STATUS ==0){
								html += ' <a href="#" onclick="bukapBandwith(\'' + no + '\',\'' + item.ID_PELAPOR + '\')"><i class="fa fa-gear fa-2x" aria-hidden="true"></i></a>';
							}
							html += '</td>';
							html +=	'</tr>'
							no++
						})
						$('#listTable').html('')
						$('#listTable').append(html)
					
				} else {
					html += '<tr><td class="text-center" colspan ="8"> Belum Ada Data</td></tr>';
					$('#listTable').html('')
						$('#listTable').append(html)
				}
			}			
		});
	}



	function exportsData(){
		// $.ajax({
		// 	data : {
		// 		'bulan' : $('#bulan').val(),
		// 		'tahun' : $('#tahun').val(),
		// 		'jenis' : $('#status').val()
		// 	},
		// 	type: 'POST',
		// 	url: '<?= base_url('/Laporan/ExcelLaporan'); ?>',
		// 	typeData: 'html',
		// 	success: function(result) {
		// 	}		
		// });
		let bulan = $('#bulan').val();
		let tahun = $('#tahun').val();
		let status = $('#status').val();
		let jenis = $('#jenis').val();
		console.log(bulan)
		console.log(tahun)
		console.log(status)
		console.log(jenis)
		window.open('<?= base_url('/Laporan/ExcelLaporan'); ?>?bulan='+bulan+'&tahun='+tahun+'&status='+status+'&jenis='+jenis);
	}



	function bukaModal(no, id){
		var id_lap = $('#id_lap'+ no).text();
		$('#mymodal1').modal('show');
		$('#id-laporan').text(id_lap);
		loadTeknisi()
	}
	function bukapBandwith(no, id){
		// alert(id)
		$('#modal-perubahan-bandwith').modal('show');
		var id_lap = $('#id_lap'+ no).text();
		var ket = $('#ket'+ no).text();
		var regex = /Perubahan bandwith menjadi : (\d+)/gi;
		match = regex.exec(ket);
		console.log(match)
		$('#id_pelapor').val(id);
		$('#p_bandwith').val(match[1]+' Mbps');
		$('#id_laporan_hidden').val(id_lap);
		// var text = 'price[5][68]';
		// loadTeknisi()
	}

	function bukaDetail(no, no_laporan){
		$('#modalDetail').modal('show');
		$.ajax({
			data : {
				'no_laporan' : no_laporan
			},
			type: 'POST',
			url: '<?= base_url('/Laporan/getdetailLaporan'); ?>',
			typeData: 'html',
			success: function(result) {
				var d = $.parseJSON(result)
				$.each(d, function(i, item) {
					if(item.STATUS == 0){
								var status = 'Belum Ditindaklanjuti';
							}else if(item.STATUS ==1){
								var status = 'Sudah Ditindaklanjuti';
							}else {
								var status = 'Selesai';
							}
					// console.log(result[NO_LAPORAN])
					$('#detail_id').text(item.NO_LAPORAN)
					$('#detail_nama').text(item.NAMA)
					$('#detail_tanggal').text(item.CREATED_TIME)
					$('#detail_alamat').text(item.ALAMAT)
					$('#detail_keterangan').text(item.KETERANGAN)
					$('#detail_status').text(status)
				}

			)}
		})

	}


	</script>
    <!-- End of Main Content -->

    <?= $this->endSection(); ?>