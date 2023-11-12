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

            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Admin/DataUser') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 60%">
                <div class="card-body">

                    <?php foreach ($users as $u) : ?>
                        <form method="POST" action="<?= base_url('Admin/update_aksiUsers') ?>">

                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $u->id_user ?>" readonly>
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $u->nama ?>" readonly>
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nip" name="nip" value="<?= $u->nip ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $u->jabatan ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $u->email ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="role" name="role" value="<?= $u->role ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">Foto Profile</div>
                                <div class="col-sm-9">
                                    <div class="row col-sm-3">
                                        <img src="<?= base_url() . 'assets/img/profile/' . $u->photo ?>" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aktivasi" class="col-sm-3 col-form-label">Aktivasi</label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="aktivasi" name="aktivasi" value="Aktif" <?= $u->aktivasi == "Aktif" ? "checked" : '' ?>>
                                        <label class="form-check-label" for="aktivasi">Aktif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="aktivasi" name="aktivasi" value="Tidak Aktif" <?= $u->aktivasi == "Tidak Aktif" ? "checked" : '' ?>>
                                        <label class="form-check-label" for="aktivasi">Tidak Aktif</label>
                                    </div>
                                </div>
                                <?= form_error('aktivasi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="Submit" class="btn btn-success">Edit</button>

                        </form>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <br><br>
    </main>