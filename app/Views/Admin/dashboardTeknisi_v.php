<?= $this->extend('Admin/Layout/templateAdmin'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                <!-- <a class="btn btn-primary">Tambah Teknisi</a> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Gangguan</th>
                                <th>Nama Pelapor</th>
                                <th>Jenis Gangguan</th>
                                <th>Tanggal Masuk Laporan</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($gangguan as $g => $value) : ?>
                                <tr>
                                    <td><?= $value->id_gangguan; ?></td>
                                    <td><?= $value->nama_pelanggan; ?></td>
                                    <td><?= $value->jenis_gangguan; ?></td>
                                    <td><?= $value->tgl_lapor; ?></td>
                                    <td><a href="/Teknisi/LihatGangguan/<?= $value->id_gangguan; ?>" class="btn btn-success">Lihat</a></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <!-- Content Row -->

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?= $this->endSection(); ?>