

<div class="container-fluid">

    <!-- Page Heading -->

    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="h3 mb-2 text-gray-800">Edit Data Pelanggan</h1>
            <a class="btn btn-primary" href="/DataPelanggan/tabelPelanggan"> Kembali</a>

        </div>
        <div class="card-body">

            <form action="" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama :</label>
                    <input type="text"  class="form-control " id="nama_pelanggan" name="nama_pelanggan">
                    
                </div>
                <div class="mb-3">
                    <label for="no_hape_pelanggan" class="form-label">Nomor Hape :</label>
                    <input type="text" class=" form-control " id="no_hape_pelanggan" name="no_hape_pelanggan">
                    
                </div>
                <div class="mb-3">
                    <label for="Jk" class="form-label">Jenis Kelamin :</label>
                    <div class="form-check">
                        <input class="form-check-input" value="laki-laki" type="radio" name="jk" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="perempuan" type="radio" name="jk" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            perempuan
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kecepatan" class="form-label">Kecepatan Internet : </label>
                    <select class="form-select " aria-label="Default select example" name="kecepatan">
                        <option value="" selected>Pilih Kecepatan Internet</option>
                        <option value="20">20mbps</option>
                        <option value="30">30mbps</option>
                        <option value="50">50mbps</option>
                        <option value="100">100mbps</option>
                        <option value="300">300mbps</option>
                    </select>
                    
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat :</label>
                    <textarea class="form-control  " id="alamat" name="alamat" ></textarea>
                    
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

