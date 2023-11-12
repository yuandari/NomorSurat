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
                    <th class="text-center">Nama Pejabat</th>
                    <th class="text-center">NIP</th>
                    <th class="text-center">Jabatan</th>
                </tr>
                <?php $no = 1;
                foreach ($pejabat as $p) : ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $p->nama_pejabat ?></td>
                        <td><?= $p->nip ?></td>
                        <td><?= $p->jabatan ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>