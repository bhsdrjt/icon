<?= $this->extend('Beranda/Layout/templateBeranda'); ?>

<?= $this->section('content'); ?>
<div class=" py-4 container"style="max-width : 1600px" >
    <div class="row">
        <div class="jumbotron">
            <h1 >Selamat Datang di </h1>
            <h1 id="oke">Website Pelaporan Gangguan Internet Iconnet</h1>
            <!-- <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p> -->
            <hr class="my-4">
            <p></p>
            <a class="btn btn-primary btn-lg" href="/Beranda/buatLaporan" role="button">Buat Laporan</a>
        </div>
    </div>
</div>
<script src="<?= base_url('/js/jquery-3.6.0.js'); ?>"></script>
<!-- <script>
    $('#oke').hide();
</script> -->
<?= $this->endSection(); ?>