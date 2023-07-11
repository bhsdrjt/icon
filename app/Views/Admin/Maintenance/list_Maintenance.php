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

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- <div class="comtainer">
        <div class="row">
            <h3>Ini Halaman Admin</h3>
        </div>
    </div> -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3text-gray-800">Maintenance</h1>
        <div class="card-header py-3">
            <a href="#" onclick="bukaModal()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> TAMBAH DATA MAINTENANCE</a>
            <a href="<?= base_url('Laporan/ExcelMaintenance'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> EXPORT EXCEL</a></div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- 

   Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                        
                        <div class="row">
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
								<select name="kd_dealer" id="kd_dealer" class="form-control" >
									<option value="">- Pilih Status -</option>
									
								</select>
							</div>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-2">
							<div class="form-group left pull-right"><br>
								<a class="btn btn-info" id="preview_btn"  name="preview_btn" role="button"><i class="fa fa-search"></i> Preview</a>
							</div>
						</div>
					</div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="listTable" width="100%" cellspacing="0">
                                <thead style="background-color: white;">
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Penanganan</th>
                                        <th>Keterangan</th>
                                        <th>Jenis Penanganan</th>
                                        <th>Status Laporan</th>
                                        <th>Aksi</th>
                                    </tr>
							    </thead>
                            <tbody>
                                <!-- <tr>
                                    <td colspan="5">
                                        <div class="text-center">
                                            <h4>Belum ada data</h4>
                                        </div>
                                    </td>
                                </tr> -->
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mymodal1" class="modal fade bd-example-modal-lg" >
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Input Data Maintenance</h3>
				<button type="button" onclick="tutup()" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
			</div>
			<form id="contactForm" name="contact" role="form">
				<div class="modal-body">				
					<!-- <div class="form-group">
						<label id="name-id" for="name"> ID Laporan Masuk  : </label>
						<label id="id-laporan" for="name"></label>
					</div> -->
					<div class="form-row">
						<div class="col-md-12 mb-2">
							<label  for="name"> Keterangan :</label>
                            <input id="keterangan" type="text" class="form-control" placeholder="Keterangan Maintenance">
						</div>
						<div class="col-md-12 mb-2">
							<label  for="name"> Tipe Pengerjaan :</label>
							<select class="form-control" name="tipe_pengerjaan" id="tipe_pengerjaan">
							<option value="Pengecekan Server">Pengecekan Server</option>
							<option value="Perawatan tiang">Perawatan tiang </option>
							<option value="Pengecheckan fiber terminal">Pengecheckan fiber terminal</option>
			
							</select>
							
                            <!-- <input id="tipe_pengerjaan" type="text" class="form-control" placeholder="Keterangan Maintenance"> -->
						</div>
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


    <script type="text/javascript" src="<?= base_url('/js/jquery-3.6.0.js'); ?>"></script>
    <script>
        
        $('document').ready(function() {
            loadData();
            loadTeknisi()
        });

    function loadTeknisi(){
		$('#nama_teknisi').inputpicker({
			url: '<?= base_url('/Teknisi/getTeknisi'); ?>',
			data:[ "NO_PEGAWAI", "NAMA" ],
			fieldText:'NAMA',
    		fieldValue:'NO_PEGAWAI',
		})
	}


    $('#btn-save').click(function() {
		var datax = __detaildata(); 
		var id_laporan = $('#id-laporan').text();
        var keterangan = $('#keterangan').val()
        var tipe_pengerjaan = $('#tipe_pengerjaan').val()
		// console.log(keterangan)
        // return false
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
					'detail' 	    : datax,
					'id_laporan'    : id_laporan,
					'jenis'		    : "maintenance",
					'keterangan'   : keterangan,
					'tipe_pengerjaan': tipe_pengerjaan
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

    function tutup(){
		$('#id-laporan').text();
		$('#listTableAdd > tbody ').empty();
		$('#mymodal1').modal('hide');
	}

    function bukaModal(no, id){
		var id_lap = $('#id_lap'+ no).text();
		$('#mymodal1').modal('show');
		// $('#id-laporan').text(id_lap);
		loadTeknisi()
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

    function loadData(){
	$.ajax({
		type: 'GET',
		url: '<?= base_url('/Laporan/getMaintenance'); ?>',
		// data: datax,
		typeData: 'html',
		success: function(result) {
			// console.log(result)
			// if(result){
			var d = $.parseJSON(result);
			// console.log(d)
			var data = d.message
			var html = `<thead style="background-color: white;">
                            <tr>
                                <th>No.</th>
                                <th>ID Penanganan</th>
                                <th>Jenis Penanganan</th>
                                <th>Keterangan</th>
                                <th>Temuan</th>
                                <th>Teknisi</th>
                                <th>Status Laporan</th>
                            </tr>
        			    </thead>`
			var no = 1
			var catatan= ''
			console.log(d)
			$.each(d, function(i, item) {
				
				var tp
				var ket
				var list_teknisi = ''
				var teknisi =  JSON.parse(item.TEKNISI);
				var tek = [...new Set(teknisi)]
				$.each(tek,function(a,b){
					list_teknisi += b.KD_TEKNISI +", ";
				})
				if(item.TIPE_PENGERJAAN == null){
					tp ='-'
				}else{
					tp = item.TIPE_PENGERJAAN
				}

				if(item.CATATAN == null){
					ket ='-'
				}else{
					ket = item.CATATAN
				}
				// console.log(list_teknisi)
				// list_teknisi = '';
				// 	// $tek = "";
				// 	if(tek == null){
				// 		$list_teknisi = '-';
				// 	}else{
				// 		$.each (tek, function ( a, t ) {
				// 			$list_teknisi += t.KD_TEKNISI;
				// 		})
				// 	}
				var no_laporan = item.NO_LAPORAN
                if(item.STATUS_PENANGANAN == 0){
                    $status_penanganan = "Belum Selesai"
                }else{
                    $status_penanganan = "Selesai"
                }


				html += '<tr>';
				html += '<td class="text-center">' + (no) + '</td>';
				html += '<td id="id_lap'+ no +'" class="text-center text-nowrap">'+ item.NO_PENANGANAN +'</i></a>'
				html += '<td class="text-left text-nowrap">' + tp + '</td>';
				html += '<td class="text-left text-nowrap">' + item.KETERANGAN + '</td>';
				html += '<td class="text-left text-nowrap">' + ket + '</td>';
				html += '<td class="text-left text-nowrap">' + list_teknisi + '</td>';
				html += '<td class="text-left text-nowrap">' + $status_penanganan + '</td>';
				// html += '<td class="text-center text-nowrap"><a href="#"><i class="fa fa-bars fa-2x " aria-hidden="true"></i></a> </td>';
				html +=	'</tr>'
                no++				
			})
			$('#listTable').html('')
			$('#listTable').append(html)
			// console.log(html)
		}
	});
}
</script>
    <!-- End of Main Content -->

    <?= $this->endSection(); ?>