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
span {cursor:pointer; }
		.number{
			margin:100px;
		}
		.minus, .plus{
			width:20px;
			height:20px;
			background:#f2f2f2;
			border-radius:4px;
			padding:8px 5px 8px 5px;
			border:1px solid #ddd;
      display: inline-block;
      vertical-align: middle;
      text-align: center;
		}
		input{
			height:34px;
      width: 100px;
      text-align: center;
      font-size: 26px;
			border:1px solid #ddd;
			border-radius:4px;
      display: inline-block;
      vertical-align: middle;
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
        <h1 class="h3text-gray-800">Master Inventory</h1>
        <div class="card-header pull-right">
            <a href="<?= base_url('Inventory/ExcelInventory'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download fa-sm text-white-50"></i> EXPORT DATA</a>
			<a href="#" onclick="bukaModal()" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> TAMBAH INVENTORY</a>
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
							<th class="text-center table-nowarp" style="width:3%">Kode Inventory.</th>
							<th class="text-center table-nowarp" style="width:10%">Nama Barang</th>
							<th class="text-center table-nowarp" >Jenis Barang</th>
							<th class="text-center table-nowarp" style="width:30%">Stock</th>
							<th class="text-center table-nowarp"style="width:10%">Aksi</th>
						</tr>
					</thead>
					<tbody id="">

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- TABEL TAMBAH INVENTORY -->
	<div id="mymodal1" class="modal fade bd-example-modal-lg" >
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Tambah Inventory Baru</h3>
				<a class="close" data-dismiss="modal">×</a>
			</div>
			<form id="formData" name="contact" role="form">
				<div class="modal-body">				
                    <div class="form-group">
                        <label id="name-id" for="name"> Nama Inventory : </label>
                        <input type="text" name="nama_inventory" id="nama_inventory"class="form-control " placeholder="Nama Inventory">
                    </div>
					<div class="form-group">
						<label id="name-id" for="name"> Jenis Barang : </label>
						<!-- <input type="text" name="jenis_inventory"  id = "jenis_inventory" class="form-control" placeholder="First name"> -->
						<select class="form-control" name="jenis_inventory" id="jenis_inventory">
							<option value=""> pilih </option>
							<option value="kabel">Kabel</option>
							<option value="router">Router</option>
							<option value="modem">Modem</option>
							<option value="switch">Switch</option>
							<option value="konektor">Konektor</option>
						</select>
					</div>
				</div>				
				<div class="modal-footer">					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="#" class="btn btn-success" type ="submit" id="btn-save" onclick="saveData()"> Simpan</a>
					<!-- <input type="submit" class="btn btn-success" id="btn-save" onclick="saveData()"> -->
				</div>
			</form>
		</div>
		</div>
	</div>


<!-- MODAL STOCK -->

	<div id="mymodalstock" class="modal fade bd-example-modal-lg" >
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Tambah Stock</h3>
				<a class="close" data-dismiss="modal">×</a>
			</div>
			<form id="formDataStock" name="contact" role="form">
				<div class="modal-body">				
                    <div class="form-group">
                        <label id="name-id" for="name"> Kode Inventory : </label>
                        <input type="text" name="kd_inventory_stock" id="kd_inventory_stock" class="form-control disabled"readonly="true">
                    </div>
                    <div class="form-group">
                        <label id="name-id" for="name"> Nama Inventory : </label>
                        <input type="text" name="nama_inventory_stock" id="nama_inventory_stock" class="form-control disabled"readonly="true">
                    </div>
                    <div class="form-group ">
						<label id="name-id" for="name"> Jumlah stock : </label>
						<span class="minus" style = "width:30px; height : 30px"><i class="fa fa-solid fa-minus"></i></span>
						<input type="text" name ="stock" id ="stock" value="1"/>
						<span class="plus" style = "width:30px; height : 30px"><i class="fa fa-solid fa-plus"></i></span>
                    </div>
				</div>				
				<div class="modal-footer">					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="#" class="btn btn-success" type ="submit" id="btn-save-stock" onclick="saveDataStock()"> Simpan</a>
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
		$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
	});
	
	function loadData(){
		$.ajax({
			type: 'GET',
			url: '<?= base_url('/Inventory/getInventory'); ?>',
			// data: datax,
			typeData: 'html',
			success: function(result) {
					var d = $.parseJSON(result);
					// console.log(d)
					var data = d.message
					var html = `<thead style="background-color: white;">
							<tr>
								<th class="text-center table-nowarp" style="width:3%">No.</th>
								<th class="text-center table-nowarp" style="width:3%">Kode Inventory.</th>
								<th class="text-center table-nowarp" style="width:10%">Nama Barang</th>
								<th class="text-center table-nowarp" >Jenis Barang</th>
								<th class="text-center table-nowarp" style="width:30%">Stock</th>
								<th class="text-center table-nowarp"style="width:10%">Aksi</th>
							</tr>
							</thead>`
					var no = 1
					$.each(d, function(i, item) {
							var no_laporan = item.NO_LAPORAN
								html += '<tr><td class="text-center">' + (no) + '</td>';
								html += '<td id="kd_inv'+ no +'" class="text-center text-nowrap">'+(item.KD_INVENTORY)+'</i></a>'
								html += '<td id="nama_inv'+ no +'" class="text-center text-nowrap">' + item.NAMA_INVENTORY + '</td>';
								html += '<td class="text-left text-nowrap">' + item.JENIS+ '</td>';
								html += '<td id="stock'+ no +'" class="text-left text-nowrap">' + item.STOCK+ '</td>';
								html += '<td class="text-left text-nowrap"><a href="#" onclick="bukaModalstock(\'' + no + '\',\'' + item.ID + '\')" class = "btn btn-success"><i class="fa fa-plus fa-sm "></i> Stock</a></td>';
								// html += '<td class="text-center text-nowrap"><a href=""><i class="fa fa-bars fa-2x " aria-hidden="true"></i></a> <a href="#" onclick="bukaModal(\'' + no + '\',\'' + item.ID + '\')"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>';
								html +=	'</tr>'
								no++
							})
							$('#listTable').html('')
							$('#listTable').append(html)
					}
				// }
		});
	}

	

	function saveData(){
		$("#btn-save").html("<i class='fa fa-spinner fa-spin'></i> Loading");
        $("#btn-save").addClass('disabled-action')
		var data = $('#formData').serialize();
		// console.log(data)
		// return false
		$.ajax({
			url: '<?= base_url('/Inventory/saveInventory'); ?>',
			type: 'POST',
			dataType: 'json',
			data:data,
			success: function(result){
				console.log(result);
				console.log(result.status);
				if(result.status === 'true'){
					swal("Berhasil!", result.message, "success");
					$('#mymodal1').modal('hide');
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

	function bukaModal(no, id){
		var id_lap = ($('#id_lap'+ no).text())?$('#id_lap'+ no).text(): "";
		$('#mymodal1').modal('show');
		$('#id-laporan').text(id_lap);
	}


	function bukaModalstock(no, id){
		var kd_inv = $('#kd_inv'+ no).text();
		var nama_inv = $('#nama_inv'+ no).text();
		var stock = $('#stock'+ no).text();
		// console.log(kd_inv)
		// console.log(nama_inv)
		$('#mymodalstock').modal('show');
		$('#kd_inventory_stock').val(kd_inv);
		$('#stock').val(stock);
		$('#nama_inventory_stock').val(nama_inv);
	}
	
	function saveDataStock(){
		$("#btn-save-stock").html("<i class='fa fa-spinner fa-spin'></i> Loading");
        $("#btn-save-stock").addClass('disabled-action')
		var data = $('#formDataStock').serialize();
		// console.log(data)
		// return false
		$.ajax({
			url: '<?= base_url('/Inventory/saveStock'); ?>',
			type: 'POST',
			dataType: 'json',
			data:data,
			success: function(result){
				console.log(result);
				console.log(result.status);
				if(result.status === 'true'){
					swal("Berhasil!", result.message, "success");
					$('#mymodalstock').modal('hide');
					$(':input','#formData')
						.not(':button, :submit, :reset, :hidden')
						.val('')
						.removeAttr('checked')
						.removeAttr('selected');
					$("#btn-save-stock").html("Simpan");
					$("#btn-save-stock").removeClass("disabled-action");
					loadData();
				}else{
					$("#btn-save-stock").html('Simpan')
                    $("#btn-save-stock").removeClass("disabled-action");
					swal("Gagal!", result.message, "error");

				}
			}
		});

	}
	</script>

    <?= $this->endSection(); ?>