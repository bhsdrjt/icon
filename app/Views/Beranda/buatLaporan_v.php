<?= $this->extend('Beranda/Layout/templateBeranda'); ?>
<?= $this->section('content'); ?>
<style>
	table {
    border-collapse:separate;
    border:solid black 1px;
    border-radius:6px;
	border-color: #D2D2D2;
}

td, th {
	/* border-left:solid black 1px; */
    border-top:solid black 1px;
	border-color: #D2D2D2;
}

th {
    /* background-color: blue; */
    border-top: none;
}

/* td:first-child, th:first-child {
     border-left: none;
} */
</style>
<!-- Begin Page Content -->
<!-- <div class="container-fluid"> -->
<div class=" py-4 container" style="max-width : 1600px">
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3text-gray-800">Master Teknisi</h1>
        <div class="card-header pull-right">
            <!-- <a href="<?= base_url('Admin/downloadExcel'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download fa-sm text-white-50"></i> EXPORT DATA</a> -->
			<a href="#" onclick="bukaAjukan()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-edit fa-sm text-white-50"></i> AJUKAN PERUBAHAN BANDWITH</a>
			<a href="#" onclick="bukaModal()" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> BUAT LAPORAN</a>
        </div>


    </div>

    <!-- Content Row -->
    <div class="row">	
	<div class="col-lg-12 padding-left-right-10">
		<div class="panel panel-default">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-stripped" id="listTable">
					<thead style="background-color: #172858; color: white">
						<tr>
                            <th class="text-center table-nowarp" style="width:3%; vertical-align: middle;">No.</th>
							<th class="text-center table-nowarp"  style="width:10%; vertical-align: middle;">No. Laporan</th>
							<th class="text-center table-nowarp" style="vertical-align: middle;">Tanggal Lapor</th>
							<th class="text-center table-nowarp" style="vertical-align: middle;">Keterangan</th>
							<th class="text-center table-nowarp" style="vertical-align: middle;">Status</th>
							<th class="text-center table-nowarp" style="vertical-align: middle;">Aksi</th>
							
						</tr>
					</thead>
					<tbody  id="">

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div id="mymodal" class="modal fade bd-example-modal-lg" >
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Buat Laporan Gangguan Internet </h3>
				<a class="close" data-dismiss="modal">×</a>
			</div>
			<form id="formData" name="formData" role="form">
				<div class="modal-body">				
					<div class="form-group">
						<label id="name-id" for="name"> ID Pelanggan : </label>
						<input type="text" name ="id_pelanggan" id  ="id_pelanggan" class="form-control disabled-action" value ="<?php echo $_SESSION['pengenal'] ?>"  readonly placeholder="<?php echo $_SESSION['pengenal'] ?>">
					</div>
					<div class="form-group disab">
						<label id="name-id" for="name"> Tanggal Pelaporan : </label>
						<input type="text" id ="tgl_lapor" name = "tgl_lapor" class="form-control disabled-action" disabled placeholder="<?php echo date('d/m/Y') ?>">
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Jenis gangguan yang terjadi : : </label>
						<select id = "jenis_gangguan" name = "jenis_gangguan"class="form-select form-control" aria-label="Default select example">
							<option selected>Pilih jenis gangguan yang terjadi</option>
							<option value="Jaringan Lelet">Jaringan Lelet</option>
							<option value="Internet Tidak Bisa Digunakan">Internet tidak bisa digunakan</option>
							<option value="Router mati">Router mati</option>
							</select>
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Berikan penjelasan lebih detail untuk membantu teknisi : </label>
						<textarea id = "keterangan" name = "keterangan" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
					</div>
					<br>
				</div>				
				<div class="modal-footer">					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="#" class="btn btn-success" type ="submit" id="btn-save" onclick="saveData()"> Simpan</a>
				</div>
			</form>
		</div>
		</div>
	</div>

	<div id="editBandwith" class="modal fade bd-example-modal-lg" >
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Ajukan Perubahan Bandwith </h3>
				<a class="close" data-dismiss="modal">×</a>
			</div>
			<form id="formDataPerubahan" name="formDataPerubahan" role="form">
				<div class="modal-body">				
					<div class="form-group">
						<label id="name-id" for="name"> ID Pelanggan : </label>
						<input type="text" name ="id_pelanggan" id  ="id_pelanggan" class="form-control disabled-action" value ="<?php echo $_SESSION['pengenal'] ?>"  readonly placeholder="<?php echo $_SESSION['pengenal'] ?>">
					</div>
					<div class="form-group disab">
						<label id="name-id" for="name"> Tanggal Pelaporan : </label>
						<input type="text" id ="tgl_lapor" name = "tgl_lapor" class="form-control disabled-action" disabled placeholder="<?php echo date('d/m/Y') ?>">
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Bandwith : </label>
						<select id = "bandwith" name = "bandwith"class="form-select form-control" aria-label="Default select example">
							<option selected>Pilih bandwith</option>
							<option value="20mbps">20mbps</option>
							<option value="30mbps">30mbps</option>
							<option value="50mbps">50mbps</option>
							<option value="100mbps">100mbps</option>
							<option value="300mbps">300mbps</option>
							<option value="500mbps">500mbps</option>
							</select>
					</div>
					
				</div>				
				<div class="modal-footer">					
					<button type="button" class="btn btn-default" id="tutup_bandwith" onclick="tutup_perubahan_bandwith()" data-dismiss="modal">Close</button>
					<a href="#" class="btn btn-success" type ="submit" id="btn-save-perubahan" onclick="savePerubahan()"> Simpan</a>
				</div>
			</form>
		</div>
		</div>
	</div>

<!-- </div> -->
    <!-- <div class="comtainer">
        <div class="row">
            <h3>Ini Halaman Admin</h3>
        </div>
    </div> -->
    <!-- Page Heading -->
    

	<script type="text/javascript" src="<?= base_url('/js/jquery-3.6.0.js'); ?>"></script>
	<script type="text/javascript">

	$(document).ready(function (){
		loadData();
	});
	
	function saveData(){
		$("#btn-save").html("<i class='fa fa-spinner fa-spin'></i> Loading");
        $("#btn-save").addClass('disabled-action')
		var data = $('#formData').serialize();
		// console.log(data);
		// return false
		$.ajax({
			url: '<?= base_url('/Laporan/saveLaporan'); ?>',
			type: 'POST',
			dataType: 'json',
			data:data,
			success: function(result){
				console.log(result);
				console.log(result.status);
				if(result.status === 'true'){
					swal("Berhasil!", result.message, "success");
					// $('#mymodal').modal('hide');
					$(':input','#formData')
						.not(':button, :submit, :reset, :hidden')
						.val('')
						.removeAttr('checked')
						.removeAttr('selected');
					loadData();
				}else{
					$("#btn-save").html('Simpan')
                    $("#btn-save").removeClass("disabled-action");
					swal("Gagal!", result.message, "error");

				}
			}
		});

	}
	function tutup_perubahan_bandwith(){
		$('#editBandwith').modal('hide');

	}


	function savePerubahan(){
		$("#btn-save-perubahan").html("<i class='fa fa-spinner fa-spin'></i> Loading");
        $("#btn-save-perubahan").addClass('disabled-action')
		var data = $('#formDataPerubahan').serialize();
		// console.log(data);
		// return false
		$.ajax({
			url: '<?= base_url('/Laporan/savePerubahanBandwith'); ?>',
			type: 'POST',
			dataType: 'json',
			data:data,
			success: function(result){
				console.log(result);
				console.log(result.status);
				if(result.status === 'true'){
					swal("Berhasil!", result.message, "success");
					$("#btn-save-perubahan").html('Simpan')
                    $("#btn-save-perubahan").removeClass("disabled-action");
					$('#tutup_bandwith').click();
					$(':input','#formDataPerubahan')
						.not(':button, :submit, :reset, :hidden')
						.val('')
						.removeAttr('checked')
						.removeAttr('selected');
					loadData();
				}else{
					$("#btn-save-perubahan").html('Simpan')
                    $("#btn-save-perubahan").removeClass("disabled-action");
					swal("Gagal!", result.message, "error");

				}
			}
		});

	}

	
	function loadData(){
		$.ajax({
			type: 'GET',
			url: '<?= base_url('/Laporan/getLaporanPelanggan'); ?>',
			// data: datax,
			typeData: 'html',
			success: function(result) {
				console.log(result)
				// if(result){
					var d = $.parseJSON(result);
					// console.log(d)
					var data = d.message
					var html = `<thead style="background-color: #172858; color: white">
							<tr>
								<th class="text-center table-nowarp" style="width:3%; vertical-align: middle;">No.</th>
								<th class="text-center table-nowarp"  style="width:10%; vertical-align: middle;">No. Laporan</th>
						    	<th class="text-center table-nowarp" style="vertical-align: middle;">Tanggal Lapor</th>
						    	<th class="text-center table-nowarp" style="vertical-align: middle;">Keterangan</th>
								<th class="text-center table-nowarp" style="vertical-align: middle;">Status</th>
								<th class="text-center table-nowarp" style="vertical-align: middle;">Aksi</th>
							</tr>
							</thead>`
					var no = 1
					$.each(d, function(i, item) {
							if(item.STATUS == 0){
								var status = 'Belum Ditindaklanjuti';
							}else if(item.STATUS ==1){
								var status = 'Sudah Ditindaklanjuti';
							}else {
								var status = 'Selesai';
							}
							var no_laporan = item.NO_LAPORAN
								html += '<tr style="background-color: white;"><td class="text-center">' + (no) + '</td>';
								html += '<td id="id_lap'+ no +'" class="text-center text-nowrap">'+(item.NO_LAPORAN)+'</i></a>'
								html += '<td class="text-left text-nowrap">' + item.CREATED_TIME + '</td>';
								html += '<td class="text-left text-nowrap">' + item.KETERANGAN + '</td>';
								html += '<td class="text-center text-nowrap">' + status + '</td>';
								html += '<td class="text-left text-nowrap">DETAIL</td>';
								// html += '<td class="text-center text-nowrap"><a href=""><i class="fa fa-bars fa-2x " aria-hidden="true"></i></a> <a href="#" onclick="bukaModal(\'' + no + '\',\'' + item.ID + '\')"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>';
								html +=	'</tr>'
								no++
								
							})
							$('#listTable').html('')
							$('#listTable').append(html)
							console.log(html)
					}
				// }
		});
	}



	function bukaModal(){
		$('#mymodal').modal('show');
	}
	function bukaAjukan(){
		$('#editBandwith').modal('show');
	}
	</script>
    <!-- End of Main Content -->

    <?= $this->endSection(); ?>