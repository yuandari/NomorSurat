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

            <div class="card" style="width: 60%">
                <div class="card-body">

                    <?php foreach ($nomor as $n) : ?>
                        <?= form_open_multipart('Pegawai/aksiUploadSurat'); ?>
                        <div class="form-group row">
                            <input type="hidden" class="form-control" name="id_nomor" id="id_nomor" value="<?= $n->id_nomor ?>" readonly>
                            <div class="col-sm-9">
                                <?php if ($n->status_verifikasi == 'Sudah') { ?>
                                    <input type="text" class="form-control" name="nomor" id="nomor" value="<?= $n->nomor ?>" readonly hidden>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file_surat" class="col-sm-3 col-form-label">File Surat</label>

                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <span class="text-danger text-xs">Unggah file pdf dengan ukuran maksimal 5 MB </span>
                                </div>
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
    </main>