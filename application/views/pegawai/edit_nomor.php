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
            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Pegawai/Nomor') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">

                    <?php foreach ($nomor as $n) : ?>
                        <?= form_open_multipart('Pegawai/update_aksiNomor'); ?>
                        <div class="form-group row">
                            <input type="hidden" class="form-control" name="id_nomor" id="id_nomor" value="<?= $n->id_nomor ?>" readonly>
                            <label for="nomor" class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <?php if ($n->status_verifikasi == 'Sudah') { ?>
                                    <input type="text" class="form-control" name="nomor" id="nomor" value="<?= $n->nomor ?>" readonly>
                                <?php } else { ?>
                                    <input type="text" class="form-control text-danger" value="Silahkan Menghubungi Sekretaris!!" readonly>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sifat" class="col-sm-3 col-form-label">Sifat</label>
                            <div class="col-sm-9 pt-2">
                                <select class="form-control" id="sifat" name="sifat">
                                    <option value="<?= $n->sifat ?>"><?= $n->sifat ?></option>
                                    <option value="Biasa">Biasa</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Terbuka">Terbuka</option>
                                    <option value="Terbatas">Terbatas</option>
                                    <option value="Rahasia">Rahasia</option>
                                    <option value="Segera">Segera</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tujuan_surat" class="col-sm-3 col-form-label">Tujuan Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tujuan_surat" name="tujuan_surat" value="<?= $n->tujuan_surat ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="perihal" name="perihal" value="<?= $n->perihal ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?= $n->tanggal_surat ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_pejabat" class="col-sm-3 col-form-label">Pejabat Penandatangan</label>
                            <div class="col-sm-9 pt-2">
                                <select class="form-control" id="id_pejabat" name="id_pejabat">
                                    <?php foreach ($pejabat as $p => $value) { ?>
                                        <option value="<?= $value->id_pejabat ?>"><?= $value->jabatan ?></option>
                                    <?php } ?>
                                </select>
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
                        <div class="form-group row">
                            <label for="file_surat" class="col-sm-3 col-form-label">File Surat</label>
                            <?php if ($n->file_surat == true) { ?>
                                <div class="col-sm-9">
                                    <a class="fas fa-solid fa-file-pdf" style="color: #2160f2;" target="_blank" href="<?= base_url() . 'assets/file/' . $n->file_surat ?>"></a>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-sm-9">
                                    <p class="text-danger">FIle Belum Tersedia</p>
                                </div>
                            <?php } ?>

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
        </div><br><br>
    </main>