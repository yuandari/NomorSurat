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

            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Admin/DataPejabat') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">

                    <?php foreach ($pejabatt as $p) : ?>
                        <form method="POST" action="<?= base_url('Admin/update_aksiPejabat') ?>">

                            <div class="form-group">
                                <label>Nama Pejabat</label>
                                <input type="hidden" class="form-control" name="id_pejabat" id="id_pejabat" value="<?= $p->id_pejabat ?>">
                                <input type="text" class="form-control" name="nama_pejabat" id="nama_pejabat" value="<?= $p->nama_pejabat ?>" required>
                                <?= form_error('nama_pejabat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" class="form-control" name="nip" id="nip" value="<?= $p->nip ?>" required>
                                <span class="text-danger text-xs">NIP harus terdiri dari 18 angka </span>
                                <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?= $p->jabatan ?>" readonly>
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