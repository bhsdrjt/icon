<link href=" <?= base_url('admin/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
<script src="<?= base_url('/admin/vendor/jquery/jquery.min.js'); ?>"></script>
        <script src="<?= base_url('/admin/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('/admin/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('/admin/js/sb-admin-2.min.js'); ?>"></script>
<nav class="navbar navbar-expand-lg" style="background-color:#172858;">
    <!-- <div class="container"> -->
        <!-- <div class="container-fluid"> -->

            <div class="collapse navbar-collapse" id="navbarColor01" style="height: 55px;">
                <!-- <img src="<public/assets/logo-icon.png" width="70" height="50"> -->
                <img src="<?= base_url('assets/logo-icon.png'); ?>" width="8%">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav me-auto"  style="font-family:Helvetica; font-size: 28px; ">
                    <li class=" nav-item">
                        <b>
                            <a class="nav-link text-light " href="/Beranda/home">Beranda</a>
                        </b>
                    </li>
                    <?php if(isset($_SESSION['islogin'])) {?>
                    <li class="nav-item">
                        <b>
                            <a class="nav-link text-light  " href="/Beranda/buatLaporan">Buat Laporan</a>
                        </b>
                    </li>
                    <?php } ?>
                    <!-- <li class="nav-item">
                        <b>
                            <a class="nav-link text-light  " href="/Beranda/buatLaporan">Buat Laporan</a>
                        </b>
                    </li> -->

                </ul>
                
                <?php if(isset($_SESSION['islogin'])) {?>
                <ul class="navbar-nav me-4">
                    <div class="topbar-divider"></div>
<!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-lg-inline text-light mr-2" style="font-size: 20px;"><?php echo $_SESSION['username'] ?></span>
                            <img class="img-profile rounded-circle" src="<?= base_url('admin/img/undraw_profile.svg'); ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/Login/logout" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <a href=""></a>
                <?php }else{; ?>
                    <a id="btn_login" class="btn btn-primary text-light "> Login</a>
                    <?php } ?>
                </div>
                
        <!-- </div> -->
    <!-- </div> -->
</nav>

<div id="dataModal" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content" >  
            <div class="row" id="content-login">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Login</h1>
                        </div>
                        <form class="user" >
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Masukkan ID ">
                            
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Masukkan Password">
                                
                            </div>
                                <!-- <button type="submit" class="btn btn-primary btn-user btn-block" onclick="login()">Login</button> -->
                                <a href="#"class="btn btn-primary btn-user btn-block" onclick="login()">Login</a>
                        </form>
                        <hr>
                        <div class="text-center">
                            Belum Punya akun? <br><a class="small" href="#" id="regist">Buat Akun!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-none"id="conten-register">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                            </div>
                            <form class="user" id="form-register">
                                <div class="form-group">
                                    <label for="id_register"> ID Pelanggan</label>
                                    <input type="text" class="form-control form-control-user" id="id_register" name="id_register" placeholder="Masukkan ID ">
                                </div>
                                <div class="form-group">
                                    <label for="username_register"> Username</label>
                                    <input type="text" class="form-control form-control-user" id="username_register" name="username_register" placeholder="Masukkan Username">
                                </div>
                                <div class="form-group">
                                    <label for="password_register"> Password</label>
                                    <input type="password" class="form-control form-control-user" id="password_register" name="password_register" placeholder="Masukkan Password">
                                </div>
                                <a href="#" onclick="register()" class="btn btn-primary btn-user btn-block">
                                    Daftar
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                 <a id="kembali" class="small" href="#"> <p> Login Sekarang!</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>  
    </div>  
</div>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Logout</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!-- <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div> -->
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/Login/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

<script src="<?= base_url('/js/jquery-3.6.0.js'); ?>"></script>
<script>

    function register(){
        console.log(data_register);
        var data_register = $('#form-register').serialize();
        var id_register = $('#id_register').val();
        var username_register = $('#username-register').val();
        var password_register = $('#password-register').val();
        if(id_register == '' || username_register == '' || password_register == ''){
            alert('Data tidak boleh kosong');
        }else if(username_register == ""){
            swal("Gagal!","Username Harus Diisi", "error");
        }else if(password_register == ""){
            swal("Gagal!","Password Harus Diisi", "error");
        }else if(id_register == ""){
            swal("Gagal!","ID Pelanggan Harus Diisi", "error");
        }else{
            $.ajax({
                url: '<?= base_url('/Login/Register'); ?>',
			    type: 'POST',
			    dataType: 'json',
			    data: data_register,
                success : function (result){
                    if(result.status == true){
                        swal("Berhasil!","Berhasil Mendaftar", "success");
                        $('#form-register')[0].reset();
                        $('#conten-register').addClass('d-none');
                        $('#content-login').removeClass('d-none');
                    }else{
                        if(result.case == 'username'){
                            swal("Gagal!",result.message, "error");
                        }else if(result.case == 'id'){
                            swal("Gagal!",result.message, "error");
                        }else{
                            swal("Gagal!",result.message, "error");
                        }
                    }

                }
            })
        }
    }
                    


    function login(){
        // window.location.href= "<?php echo base_url('Admin/dashboard')?>"
        var username = $('#username').val()
        var password = $('#password').val()
        
        if(username == "" && password == ""){
            swal("Gagal!","Username Dan Password Harus Diisi", "error");
        }else if(username == ""){
            swal("Gagal!","Username Harus Diisi", "error");
        }else if(password == ""){
            swal("Gagal!","Password Harus Diisi", "error");
        }else{
            // alert('oke')
            $.ajax({
			url: '<?= base_url('/Login/LoginProcess'); ?>',
			type: 'POST',
			dataType: 'json',
			data:{
                'username': username,
                'password': password
            },
			success: function(result){
				console.log(result)
				if(result.status == true){
                    if(result.role == "Pelanggan"){
                        swal("Berhasil!", result.massage, "success");
                        window.location.href= "<?php echo base_url('Beranda/home')?>"
                    }else{
                        if(result.role == "Admin"){
                            swal("Berhasil!", result.massage, "success");
                            window.location.href= "<?php echo base_url('Laporan/LaporanMasuk')?>"
                        }else{
                            swal("Berhasil!", result.massage, "success");
                            window.location.href= "<?php echo base_url('Laporan/Penanganan')?>"
                        }
                    }
				}else{
					swal("Gagal!", result.message, "error");
                    $('#username').val('')
                    $('#password').val('')
				}
			}
		});
            // swal("Berhasil!", result.message, "success");
    }


    }

    $('#btn_login').click(function() {
        $('#dataModal').modal('show');
        $('#regist').click(function() {
            $('#content-login').addClass('d-none')
            $('#conten-register').removeClass('d-none')
        });
        $('#kembali').click(function() {
            $('#conten-register').addClass('d-none')
            $('#content-login').removeClass('d-none')
        });
    });

    $('#btn-close').click(function() {
        $('#dataModal').modal('hide');
    });
</script>