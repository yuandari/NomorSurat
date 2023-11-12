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

            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kode Klasifikasi</th>
                    <th class="text-center">Jenis Arsip</th>
                    <th class="text-center">Persetujuan</th>
                </tr>
                <?php $no = 1;
                foreach ($klasifikasi as $kl) : ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $kl->kode_klasifikasi ?></td>
                        <td><?= $kl->jenis_arsip ?></td>
                        <td><?= $kl->persetujuan ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>