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

            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Admin/DataKlasifikasi') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">

                    <?php foreach ($kode_klasifikasi as $kl) : ?>
                        <form method="POST" action="<?= base_url('Admin/update_aksikl') ?>">

                            <div class="form-group">
                                <label>Kode Klasifikasi</label>
                                <input type="hidden" class="form-control" name="id_klasifikasi" id="id_klasifikasi" value="<?= $kl->id_klasifikasi ?>">
                                <input type="text" class="form-control" name="kode_klasifikasi" id="kode_klasifikasi" value="<?= $kl->kode_klasifikasi ?>" readonly>
                                <?= form_error('kode_klasifikasi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis Arsip</label>
                                <input type="text" class="form-control" name="jenis_arsip" id="jenis_arsip" value="<?= $kl->jenis_arsip ?>">
                                <?= form_error('jenis_arsip', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="persetujuan" class="col-sm-3 col-form-label text-left">Persetujuan</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="persetujuan" name="persetujuan" value="Ya" <?= $kl->persetujuan == "Ya" ? "checked" : '' ?>>
                                    <label class="form-check-label" for="persetujuan">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="persetujuan" name="persetujuan" value="Tidak" <?= $kl->persetujuan == "Tidak" ? "checked" : '' ?>>
                                    <label class="form-check-label" for="persetujuan">Tidak</label>
                                </div>
                                <?= form_error('persetujuan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </main>