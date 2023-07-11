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
        <h1 class="h3text-gray-800">Master Teknisi</h1>
        <div class="card-header pull-right">
            <a href="<?= base_url('Teknisi/ExcelTeknisi'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download fa-sm text-white-50"></i> EXPORT DATA</a>
			<a href="#" onclick="bukaModal()" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> TAMBAH TEKNISI</a>
        </div>


    </div>

    <!-- Content Row -->
    <div class="row">
	
	<div class="col-lg-12 padding-left-right-10">
		<div class="panel panel-default">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-stripped" id="listTable">
					<thead style="background-color: white;">
						<tr>
							<th class="text-center table-nowarp" style="width:3%">No.</th>
							<th class="text-center table-nowarp" style="width:10%">No. Pegawai</th>
							<th class="text-center table-nowarp" >Nama</th>
							<th class="text-center table-nowarp" style="width:30%">Jabatan</th>
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
				<h3>Tambah Teknisi Baru</h3>
				<a class="close" data-dismiss="modal">×</a>
			</div>
			<form id="dataTek" name="contact" role="form">
				<div class="modal-body">				
					<div class="form-group">
						<label  for="name"> Nama : </label>
						<input id="nama" name="nama" type="text" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label  for="name"> Jabatan : </label>
						<input id="jabatan" name = "jabatan" type="text" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label  for="name"> Alamat : </label>
						<input id="alamat" name = "alamat" type="text" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label  for="name"> Email : </label>
						<input id="email" name  ="email" type="text" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label  for="name"> No. Telepon : </label>
						<input id="no_telp" name = "no_telp" type="text" class="form-control" placeholder="First name">
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
		var datatek = $('#dataTek').serialize();
		$.ajax({
			url: '<?= base_url('/Teknisi/saveTeknisi'); ?>',
			type: 'POST',
			dataType: 'json',
			data:datatek,
			success: function(result){
				console.log(result)
				if(result.status === 'true'){
					swal("Berhasil!", result.message, "success");
					$('#mymodal1').modal('hide');
					$(':input','#dataTek')
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
			url: '<?= base_url('/Teknisi/getTeknisi'); ?>',
			// data: datax,
			typeData: 'html',
			success: function(result) {
					var d = $.parseJSON(result);
					// console.log(d)
					var data = d.message
					var html = `<thead style="background-color: white;">
							<tr>
								<th class="text-center table-nowarp" style="width:3%">No.</th>
								<th class="text-center table-nowarp" style="width:10%">No. Pegawai</th>
								<th class="text-center table-nowarp">Nama</th>
								<th class="text-center table-nowarp">Jabatan</th>
								<th class="text-center table-nowarp">Aksi</th>
							</tr>
							</thead>`
					var no = 1
					$.each(d, function(i, item) {
							var no_laporan = item.NO_LAPORAN
								html += '<tr><td class="text-center">' + (no) + '</td>';
								html += '<td id="id_lap'+ no +'" class="text-center text-nowrap">'+(item.NO_PEGAWAI)+'</i></a>'
								html += '<td class="text-center text-nowrap">' + item.NAMA + '</td>';
								html += '<td class="text-left text-nowrap">' + item.JABATAN + '</td>';
								html += '<td class="text-center text-nowrap"><a href="/Laporan/detailpekerjaanTeknisi/'+ item.NO_PEGAWAI +'"><i class="fa fa-print fa-2x" aria-hidden="true"></i></a> ';
								html += '<a href="#" onclick="hapus(\'' + no + '\',\'' + item.ID + '\')"><i class="fa fa-trash fa-2x "  aria-hidden="true"></i></a>';
								
								html +=	'</td>'
								html +=	'</tr>'
								no++;
								
							})
							$('#listTable').html('')
							$('#listTable').append(html)
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
				url: '<?= base_url('/Teknisi/hapusTeknisi'); ?>',
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

	function tutup(){
		// $('#no_penanganan').text();
		// $('#listTableAdd > tbody ').empty();
		$('#mymodal1').modal('hide');
		loadData();
	}

	function bukaModal(no, id){
		var id_lap = ($('#id_lap'+ no).text())?$('#id_lap'+ no).text(): "";
		$('#mymodal1').modal('show');
		$('#id-laporan').text(id_lap);
	}
	</script>
    <!-- End of Main Content -->

    <?= $this->endSection(); ?>