<?= $this->extend('Admin/Layout/templateAdmin'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<style>
	table {
		border-collapse: separate;
		border: solid black 1px;
		border-radius: 6px;
		border-color: #D2D2D2;
	}

	td,
	th {
		/* border-left:solid black 1px; */
		border-top: solid black 1px;
		border-color: #D2D2D2;
	}

	th {
		/* background-color: blue; */
		border-top: none;
	}

	span {
		cursor: pointer;
	}

	.number {
		margin: 100px;
	}

	.minus,
	.plus {
		width: 20px;
		height: 20px;
		background: #f2f2f2;
		border-radius: 4px;
		padding: 8px 5px 8px 5px;
		border: 1px solid #ddd;
		display: inline-block;
		vertical-align: middle;
		text-align: center;
	}

	input {
		height: 34px;
		width: 100px;
		text-align: center;
		font-size: 26px;
		border: 1px solid #ddd;
		border-radius: 4px;
		display: inline-block;
		vertical-align: middle;
	}
</style>
<div class="container-fluid">
	<!-- <div class="comtainer">
        <div class="row">
            <h3>Ini Halaman Admin</h3>
        </div>
    </div> -->
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between ">
		<h1 class="h3text-gray-800">Data Penanganan Laporan Gangguan</h1>
		<div class="card-header py-3">
			<a href="<?= base_url('Laporan/ExcelPenanganan'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> EXPORT EXCEL</a>
		</div>

	</div>

	<!-- Content Row -->
	<div class="row">
		<!-- 

   Begin Page Content -->
		<div class="container-fluid">
			<div class="card shadow mb-4">
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-3 col-sm-3">
							<div class="form-group">
								<label>Jenis Gangguan</label>
								<select name="kd_dealer" id="kd_dealer" class="form-control">
									<option value="">- Jenis Gangguan -</option>

								</select>
							</div>
						</div>
						<div class="col-xs-6 col-sm-3 col-md-2">
							<div class="form-group">
								<label>Bulan</label>
								<select class="form-control " id="bulan" name="bulan">
									<option value="">- Pilih Bulan -</option>
								</select>
							</div>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-2">
							<div class="form-group">
								<label>Tahun</label>
								<select class="form-control" id="tahun" name="tahun">
									<option value="">- Pilih Tahun -</option>

								</select>
							</div>
						</div>
						<div class="col-xs-6 col-sm-3 col-md-2">
							<div class="form-group">
								<label>Status Laporan</label>
								<select name="kd_dealer" id="kd_dealer" class="form-control">
									<option value="">- Pilih Status -</option>

								</select>
							</div>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-2">
							<div class="form-group left pull-right"><br>
								<a class="btn btn-info" id="preview_btn" name="preview_btn" role="button"><i class="fa fa-search"></i> Preview</a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" width="100%" cellspacing="0" id="listTable">
							<thead>
								<tr>
									<th>No.</th>
									<th>ID Penanganan</th>
									<th>ID Laporan</th>
									<th>Pelapor</th>
									<th>Jenis Penanganan</th>
									<th>Status Laporan</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>



	<div id="mymodal1" class="modal fade bd-example-modal-lg">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Laporkan Penanganan Selesai</h3>
					<button type="button" onclick="tutup()" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
				</div>
				<form id="contactForm" name="contact" role="form">
					<div class="modal-body">
						<div class="form-group">
							<label id="name-id" for="name"> No Penanganan : </label>
							<label id="no_penanganan" for="name"></label>
						</div>
						<div class="form-group">
							<label id="name-id" for="name"> Berikan Catatan : </label>
							<textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
						</div>
						<hr>
						<div class="form-row">
							<div class="col-md-7">
								<label for="name"> Inputkan Data Inventory Yang Dipakai</label>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-7">
								<label for="name"> Nama Inventory</label>
								<input id="kd_inventory" type="text" class="form-control" placeholder="Pilih Inventory">
							</div>
							<div class="col-md-3">
								<label for="name"> Jumlah</label>
								<!-- <input type="text" class="form-control" placeholder="Last name"> -->
								<div class="form-group ">
									<span class="minus" style="width:30px; height : 30px"><i class="fa fa-solid fa-minus"></i></span>
									<input type="text" name="stock" id="stock" value="1" />
									<span class="plus" style="width:30px; height : 30px"><i class="fa fa-solid fa-plus"></i></span>
								</div>
							</div>
							<div class="col-md-2">
								<label for="name"> </label>
								<a href="#" class="btn btn-success mt-4" id="tbl-tambah" onclick="tambah()" style="width: 40%; color: white">
									<i class="fa fa-plus-circle">
									</i>
								</a>
							</div>
						</div>
						<hr>
						<div class="form-row align-center">
							<table style=" margin-left: auto; margin-right: auto; width:98%;" border="1" id="listTableAdd">
								<thead>
									<th class="text-center" style="width: 60%;">Nama</th>
									<th class="text-center" style="width: 30%;">Peran</th>
									<th class="text-center" style="width: 10%;">Aksi</th>
								</thead>
								<tbody id='table-list'>
									<!-- <tr>
									<td colspan ="3">Tambahkan Data Inventory</td>
								</tr> -->
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="btn-close" onclick="tutup()" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="button" id="btn-save" class="btn btn-success">Simpan</button>
						<!-- <input type="submit" class="btn btn-success" id="submit"> -->
					</div>

				</form>
			</div>
		</div>
	</div>



	<div id="modalDetail" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content ">
				<div class="modal-header">
					<h4 class="modal-title">Detail Laporan</h4>
				</div>
				<div class="modal-body" id="detail_user">
					<div class="form-group">

						<table id="printarea" style="width:100%; border-collapse: collapse; border-style:none;" class="" border="0">
							<tr>
								<td id="name-id"> Nomor penanganan </td>
								<td>:</td>
								<td id="detail_id"></td>
							</tr>
							<tr>
								<td id="name-id"> Nomor pelaporan </td>
								<td>:</td>
								<td id="detail_laporan"></td>
							</tr>
							<tr>
								<td id="name-id"> Pelapor </td>
								<td>:</td>
								<td id="detail_nama"></td>
							</tr>
							<tr>
								<td id="name-id"> Tanggal ditangani </td>
								<td>:</td>
								<td id="detail_tanggal_m"></td>
							</tr>
							<tr>
								<td id="name-id"> Tanggal Selesai </td>
								<td>:</td>
								<td id="detail_tanggal_s"></td>
							</tr>
							<tr>
								<td id="name-id"> Status penanganan </td>
								<td>:</td>
								<td id="detail_status"></td>
							</tr>
							<tr>
								<td id="name-id"> Keterangan </td>
								<td>:</td>
								<td id="detail_keterangan"></td>
							</tr>
							<tr>
								<td id="name-id"> Catatan teknisi </td>
								<td>:</td>
								<td id="detail_catatan"></td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Teknisi yang menangani : </label>
						<table style=" margin-left: auto; margin-right: auto; width:98%;" border="1" id="listTableAdd1">
							<thead>
								<th class="text-center" style="width: 60%;">Nama</th>
								<th class="text-center" style="width: 30%;">Peran</th>
							</thead>
							<tbody id='table-listteknisi'>
								<!-- <tr>
									<td colspan ="3">Tambahkan Data Inventory</td>
								</tr> -->
							</tbody>
						</table>
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Inventory yang dipakai : </label>
						<table style=" margin-left: auto; margin-right: auto; width:98%;" border="1" id="listTableAdd2">
							<thead>
								<th class="text-center" style="width: 60%;">Inventory</th>
								<th class="text-center" style="width: 30%;">Jumlah</th>
							</thead>
							<tbody id='table-listinventory'>
								<!-- <tr>
									<td colspan ="3">Tambahkan Data Inventory</td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" id="close-detail" onclick="close_detail()" data-dismiss="modal">Close</button>
					<a type="button" class="btn btn-danger" id="printTicket" data-dismiss="modal">Print</a>
				</div>
			</div>
		</div>
	</div>


</div>
<script type="text/javascript" src="<?= base_url('/js/jquery-3.6.0.js'); ?>"></script>

<script type="text/javascript" src="<?= base_url('/js/print.min.js'); ?>"></script>

<script>
	$('document').ready(function() {
		loadData();
		$('.minus').click(function() {
			var $input = $(this).parent().find('input');
			var count = parseInt($input.val()) - 1;
			count = count < 1 ? 1 : count;
			$input.val(count);
			$input.change();
			return false;
		});
		$('.plus').click(function() {
			var $input = $(this).parent().find('input');
			$input.val(parseInt($input.val()) + 1);
			$input.change();
			return false;
		});
	});


	function loadInventory() {
		$('#kd_inventory').inputpicker({
			url: '<?= base_url('/Inventory/getInventory'); ?>',
			data: ["KD_INVENTORY", "NAMA_INVENTORY", "STOCK"],
			fieldText: 'NAMA_INVENTORY',
			fieldValue: 'KD_INVENTORY',
		})
	}

	// function printTicket(no_penanganan){
	// 	$.ajax({
	// 			url : '<?= base_url('/Laporan/printTicket'); ?>',
	// 			type: 'POST',
	//             dataType: 'json',
	// 			data : {
	// 				'no_penanganan' 	: no_penanganan
	// 			},
	// 			success : function(result){
	//                 if (result.status === 'true') {
	// 					swal("Berhasil!", result.message, "success");
	//                     $("#btn-close").click();
	// 					$("#btn-save").html('Simpan')
	//                     $("#btn-save").removeClass("disabled-action");
	//                     loadData()
	//                 } else {
	//                     $("#btn-save").html('Simpan')
	//                     $("#btn-save").removeClass("disabled-action");
	// 					swal("Gagal!", result.message, "error");
	//                 }							
	// 			}
	// 		});

	// }

	function __detaildata() {
		var jmlrow = 0;
		var datax = [];
		jmlrow = $('#listTableAdd > tbody > tr').length;
		// alert(jmlrow);
		for (i = 0; i < jmlrow; i++) {
			var exist = 0;
			exist = parseInt($('#listTableAdd > tbody > tr:eq(' + i + ') > td:eq(2)').text());
			if (isNaN(exist) || exist == 0) {
				datax.push({
					'kd_inventory': $('#listTableAdd > tbody > tr:eq(' + i + ') > td:eq(0)').text(),
					'stock': $('#listTableAdd > tbody > tr:eq(' + i + ') > td:eq(1)').text()
				});
			}
		}
		// console.log(datax)
		return datax;
	}

	function loadData() {
		$.ajax({
			type: 'GET',
			url: '<?= base_url('/Laporan/getPenanganan'); ?>',
			// data: datax,
			typeData: 'html',
			success: function(result) {
				// console.log(result)
				// if(result){
				var d = $.parseJSON(result);
				console.log(d)
				var data = d.message
				var html = `<thead style="background-color: white;">
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Penanganan</th>
                                        <th>ID Laporan</th>
                                        <th>Pelapor</th>
                                        <th>Jenis Penanganan</th>
                                        <th>Tanggal Di disposisi</th>
                                        <th>Status Laporan</th>
                                        <th>Aksi</th>
                                    </tr>
							    </thead>`
				var no = 1
				$.each(d, function(i, item) {
					var no_laporan = (item.NO_LAPORAN == null) ? '-' : item.NO_LAPORAN
					if (item.STATUS_PENANGANAN == '1') {
						var status = 'Sedang Ditangani'
					} else if (item.STATUS_PENANGANAN == '2') {
						var status = 'Selesai'
					}
					var nama = (item.NAMA) ? item.NAMA : '-'
					html += '<tr>';
					html += '<td class="text-center">' + (no) + '</td>';
					html += '<td id = "no_pen' + no + '" class="text-left text-nowrap">' + item.NO_PENANGANAN + '</td>';
					html += '<td class="text-left text-nowrap">' + no_laporan + '</td>';
					html += '<td class="text-left text-nowrap">' + nama + '</td>';
					html += '<td class="text-left text-nowrap">' + item.JENIS_PENANGANAN.toUpperCase() + '</td>';
					html += '<td class="text-left text-nowrap">' + item.CREATED_TIME + '</td>';
					html += '<td class="text-left text-nowrap">' + status + '</td>';
					html += '<td class="text-center text-nowrap">'

					html += '<a href="#" onclick="bukaDetail(\'' + no + '\',\'' + item.NO_PENANGANAN + '\')" ><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>'
					if (item.STATUS_PENANGANAN == '1' && item.PERAN == 'Penanggung Jawab') {
						html += ' <a href="#" onclick="bukaModal(\'' + no + '\',\'' + item.ID + '\')"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>'
					}
					html += '</td>';
					html += '</tr>'
					no++

				})
				$('#listTable').html('')
				$('#listTable').append(html)
				console.log(html)
			}
			// }
		});
	}


	function close_detail() {
		$('#modalDetail').modal('hide');
		$('#table-listteknisi').empty()
		$('#table-listinventory').empty();

	}



	function bukaModal(no, id) {
		var no_pen = $('#no_pen' + no).text();
		$('#mymodal1').modal('show');
		loadInventory();
		$('#no_penanganan').text(no_pen);
		// loadTeknisi()
	}

	function tambah() {
		var kd_inventory = $('#kd_inventory').val();
		var stock = $('#stock').val();
		if (kd_inventory == '' || stock == '') {
			swal("Inputan Salah!", "Nama dan Peran tidak boleh kosong!", "error");
			// alert('Nama dan Peran tidak boleh kosong');
		} else {
			var html = "";
			html += '<tr>';
			html += '<td>' + kd_inventory + '</td>';
			html += '<td>' + stock + '</td>';
			html += '<td><a href="#" class="btn btn-danger" onclick="hapus(this)"> 	<i class="fa fa-trash"></i></a></td>';
			html += '</tr>';
			$('#table-list').append(html);
			$('#inputpicker-1').val('');
			$('#inputpicker-1').text('');
			$('#stock').val('1');
		}
	}

	$('#btn-save').click(function() {
		var datax = __detaildata();
		// console.log(datax)
		// return false
		var no_penanganan = $('#no_penanganan').text();
		var catatan = $('#catatan').val();

		$("#btn-save").html("<i class='fa fa-spinner fa-spin'></i> Loading");
		$("#btn-save").addClass('disabled-action')
		$.ajax({
			url: '<?= base_url('/Laporan/simpanPenangananSelesai'); ?>',
			type: 'POST',
			dataType: 'json',
			data: {
				'detail': datax,
				'no_penanganan': no_penanganan,
				'catatan': catatan
			},
			success: function(result) {
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
		// }

	});

	function bukaDetail(no, no_penanganan) {
		$('#modalDetail').modal('show');
		// alert(no_laporan)
		$.ajax({
			data: {
				'no_penanganan': no_penanganan
			},
			type: 'POST',
			url: '<?= base_url('/Laporan/getdetailPenanganan'); ?>',
			typeData: 'html',
			success: function(result) {
				var d = $.parseJSON(result)
				// console.log(d)
				if (d.status_penanganan == '1') {
					var status = 'Sedang Ditangani'
				} else {
					var status = 'Selesai'
				}
				$('#detail_id').text(d.no_penanganan)
				$('#detail_laporan').text(d.no_laporan)
				$('#detail_nama').text(d.pelapor)
				$('#detail_tanggal_m').text(d.tanggal_ditangani)
				$('#detail_tanggal_s').text(d.tanggal_selesai)
				$('#detail_catatan').text(d.catatan)
				$('#detail_status').text(status)
				$('#detail_keterangan').text(d.keterangan)
				$('#printTicket').attr('href', '<?= base_url('/Laporan/printTicket'); ?>/' + d.no_penanganan)
				var teknisi = '';
				var inventory = '';
				$.each(d.teknisi, function(i, item) {
					if (item.teknisi == null) {
						teknisi = '-';
					} else {
						teknisi = item.teknisi
					}
					var html = "";
					html += '<tr>';
					html += '<td>' + item.teknisi + '</td>';
					html += '<td>' + item.peran + '</td>';
					html += '</tr>';
					$('#table-listteknisi').append(html);
				})
				$.each(d.inventory, function(i, item) {
					if (item.inventory == null) {
						inventory = '-';
					} else {
						inventory = item.inventory
					}
					var html = "";
					html += '<tr>';
					html += '<td>' + item.inventory + '</td>';
					html += '<td>' + item.jumlah + '</td>';
					html += '</tr>';
					$('#table-listinventory').append(html);
				})




			}
		})

	}

	function tutup() {
		$('#no_penanganan').text();
		$('#listTableAdd > tbody ').empty();
		$('#mymodal1').modal('hide');
		loadData();
	}
</script>
<!-- End of Main Content -->

<?= $this->endSection(); ?>