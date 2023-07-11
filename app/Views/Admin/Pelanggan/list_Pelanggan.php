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
<div class="container-fluid">
    <!-- <div class="comtainer">
        <div class="row">
            <h3>Ini Halaman Admin</h3>
        </div>
    </div> -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3text-gray-800">Master Pelanggan</h1>
        <div class="card-header pull-right">
            <a href="<?= base_url('Pelanggan/ExcelPelanggan'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download fa-sm text-white-50"></i> EXPORT DATA</a>
			<a href="#" onclick="bukaModal()" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> TAMBAH PELANGGAN</a>
        </div>


    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- 

   Begin Page Content -->
        <!-- <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
				<div class="panel-body panel-body-border" >
				<form id="" class="bucket-form" method="get">
					<div class="row">
						<div class="col-xs-3 col-sm-3 col-sm-2">
							<div class="form-group">
								<label>Jenis Gangguan</label>
								<select name="kd_dealer" id="kd_dealer" class="form-control" required="true">
									<option value="">- Pilih Dealer -</option>
									
								</select>
							</div>
						</div>

						<div class="col-xs-3 col-sm-3 col-md-2">
							<div class="form-group">
								<label>Bulan</label>
								<select class="form-control " id="bulan" name="b">
									<option disabled value="">- Pilih Bulan -</option>
									
								</select>
							</div>
						</div>

						<div class="col-xs-3 col-sm-2 col-md-2">
							<div class="form-group">
								<label>Tahun</label>
								<select class="form-control" id="tahun" name="t">
									<option disabled value="">- Pilih Tahun -</option>
									<
								</select>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-2">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" id="tahun" name="t">
									<option disabled value="">- Pilih Tahun -</option>
									<
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
    </div> -->
	
	<div class="col-lg-12 padding-left-right-10">
		<div class="panel panel-default">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-stripped" id="listTable">
					<thead style="background-color: white;">
						<tr>
							<th class="text-center table-nowarp" style="width:3%">No.</th>
							<th class="text-center table-nowarp" style="width:10%">No. Pelanggan</th>
							<th class="text-center table-nowarp" >Nama</th>
							<th class="text-center table-nowarp" style="width:30%">Bandwith</th>
							<th class="text-center table-nowarp"style="width:10%">Aksi</th>
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
				<h3>Tambah Pelanggan Baru</h3>
				<a class="close" data-dismiss="modal">×</a>
			</div>
			<form id="dataForm" name="contact" role="form">
				<div class="modal-body">				
                    <div class="form-group">
                        <label id="name-id" for="name"> NIK : </label>
                        <input type="text" id="nik" name="nik" class="form-control" placeholder="First name">
                    </div>
					<div class="form-group">
						<label id="name-id" for="name"> Nama : </label>
						<input type="text" id="nama" name="nama" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Alamat : </label>
						<input type="text" id="alamat" name="alamat" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Email : </label>
						<input type="text" id="email" name="email" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> No. Telepon : </label>
						<input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label id="name-id" for="name"> Bandwith : </label>
						<select id = "bandwith" name = "bandwith"class="form-select form-control" aria-label="Default select example">
							<option selected>Pilih bandwith</option>
							<option value="20 Mbps">20mbps</option>
							<option value="30 Mbps">30mbps</option>
							<option value="50 Mbps">50mbps</option>
							<option value="100 Mbps">100mbps</option>
							<option value="300 Mbps">300mbps</option>
							<option value="500 Mbps">500mbps</option>
							</select>
					</div>
					<br>
				</div>				
				<div class="modal-footer">					
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
					<button type="button" id="btn-close" onclick="tutup()" class="btn btn-danger" data-dismiss="modal">Close</button>
					<a href="#" class="btn btn-success" type ="submit" id="btn-save" onclick="saveData()"> Simpan</a>
					<!-- <input type="submit" class="btn btn-success" id="btn-save" onclick="saveData()"> -->
				</div>
			</form>
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
	});

	function saveData(){
		$("#btn-save").html("<i class='fa fa-spinner fa-spin'></i> Loading");
        $("#btn-save").addClass('disabled-action')
		var dataForm = $('#dataForm').serialize();
		// console.log(dataForm)
		// return false
		$.ajax({
			url: '<?= base_url('/Pelanggan/savePelanggan'); ?>',
			type: 'POST',
			dataType: 'json',
			data:dataForm,
			success: function(result){
				console.log(result)
				if(result.status === 'true'){
					swal("Berhasil!", result.message, "success");
					$('#mymodal1').modal('hide');
					$(':input','#dataForm')
						.not(':button, :submit, :reset, :hidden')
						.val('')
						.removeAttr('checked')
						.removeAttr('selected');
					$("#btn-save").html('Simpan')
                    $("#btn-save").removeClass("disabled-action");
					loadData();
				}else{
					$("#btn-save").html('Simpan')
                    $("#btn-save").removeClass("disabled-action");
					swal("Gagal!", result.message, "error");
				}
			}
		});

	}
	
	function loadData(){
		$.ajax({
			type: 'GET',
			url: '<?= base_url('/Pelanggan/getPelanggan'); ?>',
			// data: datax,
			typeData: 'html',
			success: function(result) {
				console.log(result)
				// if(result){
					var d = $.parseJSON(result);
					// console.log(d)
					var data = d.message
					var html = `<thead style="background-color: white;">
							<tr>
								<th class="text-center table-nowarp" style="width:3%">No.</th>
								<th class="text-center table-nowarp" style="width:10%">No. Pelanggan</th>
								<th class="text-center table-nowarp">Nama</th>
								<th class="text-center table-nowarp">Bandwith</th>
								<th class="text-center table-nowarp">Aksi</th>
							</tr>
							</thead>`
					var no = 1
					$.each(d, function(i, item) {
							var no_laporan = item.NO_LAPORAN
								html += '<tr><td class="text-center">' + (no) + '</td>';
								html += '<td id="id_pel'+ no +'" class="text-center text-nowrap">'+(item.NO_PELANGGAN)+'</i></a>'
								html += '<td class="text-center text-nowrap">' + item.NAMA + '</td>';
								html += '<td class="text-left text-nowrap">' + item.BANDWITH + '</td>';
								html += '<td class="text-left text-nowrap">';
								html += '<a href="#" onclick="hapus(\'' + no + '\',\'' + item.ID + '\')"><i class="fa fa-trash fa-2x "  aria-hidden="true"></i></a> ';
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

	function hapus (no, id){
		
		swal({
        title: 'Yakin Ingin Menghapus Data Ini?',
        text: 'Data Ini Akan hilang permanen jika dihapus!',
        icon: 'warning',
        buttons: ["Tidak", "Ya!"],
   		 }).then(function(value){
			if (value) {
            // window.location.href = url;
			$.ajax({
				type: 'POST',
				url: '<?= base_url('/Pelanggan/hapusPelanggan'); ?>',
				// data: datax,
				dataType: 'json',
				data : {
					'id' 	: id,
				},
				success : function(result){
			        if (result.status === 'true') {
						swal("Berhasil!", result.message, "success");
	
			            loadData()
			        } else {
	
						swal("Gagal!", result.message, "error");
			        }							
				}
			})
        	}
		 })
	}

	function bukaModal(no, id){
		var id_lap = ($('#id_lap'+ no).text())?$('#id_lap'+ no).text(): "";
		$('#mymodal1').modal('show');
		$('#id-laporan').text(id_lap);
	}
	</script>
    <!-- End of Main Content -->

    <?= $this->endSection(); ?>