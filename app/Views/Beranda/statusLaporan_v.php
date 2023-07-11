<?= $this->extend('Beranda/Layout/templateBeranda'); ?>



<?= $this->section('content'); ?>
<div class="contaier-fluid py-5 ">
    <div class="container">
        <form action="/Beranda/search" method="post">
            <?= csrf_field(); ?>
            <div class="input-group">
                <input type="text" name="cari" class="form-control" placeholder="Cari ID Gangguan">
                <!-- <div class="input-group-append"> -->
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
                <!-- </div> -->
            </div>
        </form>
        <div class="row ">
            <div class="jumbotron ">
                <div class="col ">
                    <div class="mb-3 ">
                        <label for="nama_pelanggan" class="form-label"> ID Gangguan :<?php if (session()->getFlashdata('id')) : ?>
                            <b> <?= session()->getFlashdata('id'); ?></b>
                        <?php endif; ?>
                        </label>

                    </div>
                    <div class="mb-3 ">
                        <label for="nama_pelanggan" class="form-label"> Status Laporan :<?php if (session()->getFlashdata('status')) : ?>
                            <b> <?= session()->getFlashdata('status'); ?></b>
                        <?php endif; ?>
                        </label>

                    </div>

                    <div class="mb-3 ">
                        <label for="nama_pelanggan" class="form-label"> Teknisi Yang Menangani :<?php if (session()->getFlashdata('teknisi')) : ?>
                            <b><?= session()->getFlashdata('teknisi'); ?></b>
                        <?php endif; ?>
                        </label>

                    </div>
                    <div class="mb-3 ">
                        <label for="nama_pelanggan" class="form-label"> Nomor Handphone Teknisi :<?php if (session()->getFlashdata('hape')) : ?>
                            <b><?= session()->getFlashdata('hape'); ?></b>
                        <?php endif; ?>
                        </label>
                    </div>
                    <div class="mb-3 ">
                        <label for="nama_pelanggan" class="form-label"> Keterangan :<?php if (session()->getFlashdata('balasan')) : ?>
                            <b><?= session()->getFlashdata('balasan'); ?></b>
                        <?php endif; ?>
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>