<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <!-- Page Heading -->
        <div class="container-fluid px-4">
            <!-- Tittle -->
            <h4 class="mt-4"><?= $title ?></h4>

            <div class="mb-4">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Pegawai/') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">
                    <form action="<?= base_url('Pegawai/ganti_password'); ?>" method="post">
                        <div class="form-group">
                            <label for="password_sekarang">Password Saat Ini</label>
                            <input type="password" class="form-control" name="password_sekarang" id="password_sekarang">
                            <?= form_error('password_sekarang', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password_baru1">Password Baru</label>
                            <input type="password" class="form-control" name="password_baru1" id="password_baru1">
                            <?= form_error('password_baru1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password_baru2">Ulangi Password</label>
                            <input type="password" class="form-control" name="password_baru2" id="password_baru2">
                            <?= form_error('password_baru2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>