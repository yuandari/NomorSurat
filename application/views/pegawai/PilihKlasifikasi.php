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
                    <form method="POST" action="<?= base_url('Pegawai/form') ?>">
                        <div class="form-group row">
                            <label for="nomor" class="col-sm-3 col-form-label">Jenis Arsip</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="nomor" id="nomor" required>
                                    <option value="">--Pilih Jenis Arsip--</option>
                                    <?php foreach ($klasifikasi as $kl => $value) { ?>
                                        <option value="<?= $value->id_klasifikasi ?>"><?= $value->jenis_arsip ?></option>
                                    <?php } ?>
                                </select>
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