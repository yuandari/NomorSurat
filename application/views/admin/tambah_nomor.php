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

            <div class="card" style="width: 60%">
                <div class="card-body">
                    <form method="POST" action="<?= base_url('Admin/tambah_aksiNomor/') ?>">
                        <div class="form-group row">
                            <label for="sifat" class="col-sm-3 col-form-label">Sifat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sifat" name="sifat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tujuan_surat" class="col-sm-3 col-form-label">Tujuan Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tujuan_surat" name="tujuan_surat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="perihal" name="perihal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pejabat_penandatangan" class="col-sm-3 col-form-label">Pejabat Penandatangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pejabat_penandatangan" name="pejabat_penandatangan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user" class="col-sm-3 col-form-label">Petugas Input</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_user" name="id_user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kode" class="col-sm-3 col-form-label">Jenis Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_kode" name="id_kode">
                            </div>
                            <?= form_error('id_kode', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row">
                            <label for="id_klasifikasi" class="col-sm-3 col-form-label">Jenis Arsip</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_klasifikasi" name="id_klasifikasi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file_surat" class="col-sm-3 col-form-label">File Surat</label>
                            </label>
                            <div class="col-sm-9">
                                <a class="fas fa-fw fa-file-pdf" target="_blank"></a>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
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