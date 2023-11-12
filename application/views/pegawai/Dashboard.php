<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <!-- Page Heading -->
        <div class="container-fluid px-4">
            <!-- Tittle -->
            <h4 class="mt-4"><?= $title ?></h4>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Nomor Surat</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $nomor ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-folder fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Data Pejabat</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pejabat ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-solid fa-briefcasefa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Data Klasifikasi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $klasifikasi ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <!-- Content Row -->
            <div class="col-lg">
                <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="card mb-4">
                <!-- Page Heading -->
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <i class="fas fa-table"></i>
                        <h6 class="text-left">Data Surat Belum Lengkap</h6>
                        <a class="btn btn-sm btn-success mb-0" href=" <?= base_url('Pegawai/tambah_nmr/') ?>">
                            <i class="fas fa-plus"> </i> Ajukan Nomor
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="card-body">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-colums">
                        <div class="datatable-container">

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
                                    foreach ($nomorr as $n) : ?>
                                        <?php if ($n->id_user == $user['id_user']) { ?>
                                            <?php if ($n->file_surat == false) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?></td>
                                                    <td><?= $n->sifat ?></td>
                                                    <td><?php if ($n->status_verifikasi == 'Sudah') { ?>
                                                            <p><?= $n->nomor ?></p>
                                                        <?php } else { ?>
                                                            <?php if ($n->status_verifikasi == 'Tolak') { ?>
                                                                <p class="text-danger">Permintaan ditolak ! <br> Perbaiki !</p>
                                                            <?php } else { ?>
                                                                <p class="text-danger">Silahkan Menghubungi Sekretaris!!</p>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= $n->tujuan_surat ?></td>
                                                    <td><?= $n->perihal ?></td>
                                                    <td><?= date('d/m/Y', strtotime($n->tanggal_surat)); ?></td>
                                                    <td><?= $n->jabatan ?></td>
                                                    <td class="text-center">
                                                        <?php if ($n->file_surat == false) { ?>
                                                            <?php if ($n->status_verifikasi == 'Sudah') { ?>
                                                                <?php if ($n->id_user == $user['id_user']) { ?>
                                                                    <a class="btn btn-sm bg-dark text-white" href="<?= base_url('Pegawai/uploadSurat/' . $n->id_nomor) ?>">
                                                                        Upload
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <i class="fas fa-exclamation"></i>
                                                                <?php } ?>

                                                            <?php } else { ?>
                                                                <i class="fas fa-regular fa-circle-xmark"></i>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <a class="fas fa-fw fa-file-pdf" target="_blank" href="<?= base_url() . 'assets/file/' . $n->file_surat ?>"></a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <center>
                                                            <?php if ($n->file_surat == false) { ?>
                                                                <?php if ($n->id_user == $user['id_user']) { ?>
                                                                    <a class="btn btn-sm btn-warning text-dark" href="<?= base_url('Pegawai/detailNomor/' . $n->id_nomor) ?>">
                                                                        Detail
                                                                    </a>
                                                                    <a class="btn btn-sm btn-primary" href="<?= base_url('Pegawai/editNomor/' . $n->id_nomor) ?>">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a class="btn btn-sm btn-warning text-dark" href="<?= base_url('Pegawai/detailNomor/' . $n->id_nomor) ?>">
                                                                        Detail
                                                                    </a>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <a class="btn btn-sm btn-warning text-dark" href="<?= base_url('Pegawai/detailNomor/' . $n->id_nomor) ?>">
                                                                    Detail
                                                                </a>
                                                            <?php } ?>

                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>