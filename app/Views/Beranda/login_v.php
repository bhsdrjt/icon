<?= $this->extend('Beranda/Layout/templateBeranda'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <form class="user" action="/Login/loginProcess">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user <?= (session()->getFlashdata('errID')) ? 'is-invalid' : ''; ?>" name="id" placeholder="Masukkan ID ">
                                        <div class="invalid-feedback">
                                            <?= (session()->getFlashdata('errID')); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user <?= (session()->getFlashdata('errPass')) ? 'is-invalid' : ''; ?> " name="password" placeholder="Masukkan Password">
                                        <div class="invalid-feedback">
                                            <?= (session()->getFlashdata('errPass')); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>