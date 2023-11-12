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
            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Admin/Profile') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">
                    <?= form_open_multipart('Admin/edit_profile'); ?>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" value="<?= $user['nama'] ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nip" id="nip" value="<?= $user['nip'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?= $user['jabatan'] ?>">
                            <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label">Foto Profile</div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/') . $user['photo'] ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9 pt-5">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="photo">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <span class="text-danger text-xs">Untuk hasil yang baik, unggah gambar jpg/jpeg/png dengan rasio 1:1 <br> Ukuran maksimal 2MB </span>
                                    </div>
                                </div>
                            </div>
                        </div>
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