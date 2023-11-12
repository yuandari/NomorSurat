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
            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Admin/Nomor') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">

                    <?php foreach ($nomor as $n) : ?>
                        <?= form_open_multipart('Admin/aksiSetujui'); ?>
                        <div class="form-group row">
                            <input type="hidden" class="form-control" name="id_nomor" id="id_nomor" value="<?= $n->id_nomor ?>" readonly>
                            <label for="nomor" class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <?php if ($n->status_verifikasi == 'Sudah') { ?>
                                    <input type="text" class="form-control" name="nomor" id="nomor" value="<?= $n->nomor ?>" readonly>
                                <?php } else { ?>
                                    <input type="text" class="form-control text-danger" value="<?= $n->nomor ?>" readonly>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sifat" class="col-sm-3 col-form-label">Sifat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sifat" name="sifat" value="<?= $n->sifat ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tujuan_surat" class="col-sm-3 col-form-label">Tujuan Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tujuan_surat" name="tujuan_surat" value="<?= $n->tujuan_surat ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="perihal" name="perihal" value="<?= $n->perihal ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?= $n->tanggal_surat ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row" readonly>
                            <label for="id_pejabat" class="col-sm-3 col-form-label">Pejabat Penandatangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_pejabat" name="id_pejabat" value="<?= $n->jabatan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user" class="col-sm-3 col-form-label">Petugas Input</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $n->nama ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_klasifikasi" class="col-sm-3 col-form-label">Jenis Arsip</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_klasifikasi" name="id_klasifikasi" value="<?= $n->jenis_arsip ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row" readonly>
                            <label for="file_surat" class="col-sm-3 col-form-label">File Surat</label>
                            <div class="col-sm-9">
                                <?php if ($n->file_surat == true) { ?>
                                    <a class="fas fa-fw fa-file-pdf" target="_blank" href="<?= base_url() . 'assets/file/' . $n->file_surat ?>"></a>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                <?php } else { ?>
                                    <p class="text-danger">FIle Belum Tersedia</p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_verifikasi" class="col-sm-3 col-form-label">Permintaan Nomor</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="status_verifikasi" name="status_verifikasi" value="Sudah" <?= $n->status_verifikasi == "Sudah" ? "checked" : '' ?>>
                                    <label class="form-check-label" for="status_verifikasi">Setujui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="status_verifikasi" name="status_verifikasi" value="Belum" <?= $n->status_verifikasi == "Belum" ? "checked" : '' ?>>
                                    <label class="form-check-label" for="status_verifikasi">Pending</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="status_verifikasi" name="status_verifikasi" value="Tolak" <?= $n->status_verifikasi == "Tolak" ? "checked" : '' ?>>
                                    <label class="form-check-label" for="status_verifikasi">Tolak</label>
                                </div>
                                <?= form_error('status_verifikasi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
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
        <br><br>
    </main>