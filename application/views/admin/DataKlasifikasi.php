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

            <a class="btn btn-sm btn-success mb-3" href="<?= base_url('Admin/tambah_datakl/') ?>">
                <i class="fas fa-plus"></i>Tambah Data
            </a>

            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kode Klasifikasi</th>
                    <th class="text-center">Jenis Arsip</th>
                    <th class="text-center">Persetujuan</th>
                    <th class="text-center">Action</th>
                </tr>
                <?php $no = 1;
                foreach ($klasifikasi as $kl) : ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $kl->kode_klasifikasi ?></td>
                        <td><?= $kl->jenis_arsip ?></td>
                        <td><?= $kl->persetujuan ?></td>
                        <td>
                            <center>
                                <a class="btn btn-sm btn-primary" href="<?= base_url('Admin/update_datakl/' . $kl->id_klasifikasi) ?>">
                                    <i class="fas fa-edit"> Edit</i>
                                </a>
                            </center>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>