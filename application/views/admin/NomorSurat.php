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
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-success" href="<?= base_url('Admin/print') ?>">
                        <i class="fa fa-print"></i> Print</a>
                    <!-- <div class="navbar-form navbar right">
                        <?php echo form_open('Admin/search') ?>
                        <input type="text" name="keyword" class="form-control" placeholder="Search">
                        <button type="submit" class="btn btn-success">Cari</button>
                        <?php echo form_close() ?>
                    </div> -->
                </div>

                <div class="card-body">
                    <table id="datatablesSimple" class="datatable-table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Sifat</th>
                                <th class="text-center">Nomor Surat</th>
                                <th class="text-center">Tujuan Surat</th>
                                <th class="text-center">Perihal</th>
                                <th class="text-center">Tanggal Surat</th>
                                <th class="text-center">Pejabat Penandatangan</th>
                                <th class="text-center">File Surat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                            foreach ($nomor as $n) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $n->sifat ?></td>
                                    <td><?php if ($n->status_verifikasi == 'Sudah') { ?>
                                            <p><?= $n->nomor ?></p>
                                        <?php } else { ?>
                                            <?php if ($n->status_verifikasi == 'Belum') { ?>
                                                <a class="btn btn-sm btn-danger text-center" href="<?= base_url('Admin/Setujui/' . $n->id_nomor) ?>">
                                                    Setujui
                                                </a>
                                            <?php } elseif ($n->status_verifikasi == 'Tolak') { ?>
                                                <p class="text-danger">Ditolak, Perbaiki !</p>
                                                <a class="btn btn-sm btn-danger text-center" href="<?= base_url('Admin/Setujui/' . $n->id_nomor) ?>">
                                                    Setujui
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <td><?= $n->tujuan_surat ?></td>
                                    <td><?= $n->perihal ?></td>
                                    <td><?= date('d/m/Y', strtotime($n->tanggal_surat));  ?></td>
                                    <td><?= $n->jabatan ?></td>
                                    <td class="text-center">
                                        <?php if ($n->file_surat == true) { ?>
                                            <a class="fas fa-solid fa-file-pdf" style="color: #2160f2;" target="_blank" href="<?= base_url() . 'assets/file/' . $n->file_surat ?>"></a>
                                        <?php } else { ?>
                                            <i class="fas fa-regular fa-circle-xmark"></i>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-warning text-dark" href="<?= base_url('Admin/detailNomor/' . $n->id_nomor) ?>">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing
                            </div>
                            <nav class="datatable-pagination"></nav>
                        </div> -->
            </div>
        </div>
</div>
</div>
</main>