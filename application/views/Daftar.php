<div class="container">

    <!-- Outer Row -->
    <div class="card login-form border-0 shadow-lg my-5 col-lg-5 mx-auto">
        <div class="card-body">
            <p class="text-center pt-3 pb-3">
                <img src="<?= base_url('assets/img/logo2_pupr.png') ?>" alt="" height="80" srcset="">
            </p>

            <h3 class="card-title text-center font-weight-bold text-gray-900">Silahkan Daftar</h3><br>

            <div class="card-text">
                <form class="user" method="post" action="<?= base_url('Login/Daftar') ?>">
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-fw fa-user mr-3"></i>
                            <input type="text" class="floating-input text-medium color-medium form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap" value="<?= set_value('name'); ?>">
                        </div>
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-fw fa-id-card mr-3"></i>
                            <input type="text" class="floating-input text-medium color-medium form-control" id="nip" name="nip" placeholder="Masukkan NIP " value="<?= set_value('nip'); ?>">
                        </div>
                        <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-fw fa-briefcase mr-3"></i>
                            <input type="text" class="floating-input text-medium color-medium form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan " value="<?= set_value('jabatan'); ?>">
                        </div>
                        <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class=" form-group">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-fw fa-envelope mr-3"></i>
                            <input type="text" class="floating-input text-medium color-medium form-control" id="email" name="email" placeholder="Masukkan Email" value="<?= set_value('email'); ?>">
                        </div>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class=" form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-fw fa-key mr-3"></i>
                                <input type="password" class="floating-input text-medium color-medium form-control" id="password1" name="password1" placeholder="Password">
                            </div>
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="floating-input text-medium color-medium form-control" id="password2" name="password2" placeholder="Ulangi Password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Buat Akun
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="medium" href="<?= base_url('Login'); ?>">Sudah punya akun! Login!</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>