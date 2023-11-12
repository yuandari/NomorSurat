<div class="container">

    <!-- Outer Row -->
    <div class="card login-form border-0 shadow-lg my-5 col-lg-5 mx-auto">
        <div class="card-body">
            <p class="text-center pt-3 pb-3">
                <img src="<?= base_url('assets/img/logo2_pupr.png') ?>" alt="" height="80" srcset="">
            </p>

            <h3 class="card-title text-center font-weight-bold text-gray-900">Silahkan Login</h3><br>

            <?= $this->session->flashdata('message'); ?>

            <div class="card-text">
                <form class="user" method="post" action="<?= base_url('Login') ?>">
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-fw fa-user mr-3"></i>
                            <input type="text" class="floating-input text-medium color-medium form-control" id="email" name="email" placeholder="Masukkan Alamat Email" value="<?= set_value('email'); ?>">
                        </div>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-fw fa-key mr-3"></i>
                            <input type="password" class="floating-input text-medium color-medium form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                    </button>
                </form>
                <!-- <hr>
                <div class="text-center">
                    <a class="medium" href="<?= base_url('Login/Daftar'); ?>">Buat Akun!</a>
                </div> -->
                <div class="notif mt-3 pb-2 text-center">
                    <?php echo $this->session->flashdata('pesan'); ?>
                </div>
            </div>
        </div>
    </div>

</div>

</div>