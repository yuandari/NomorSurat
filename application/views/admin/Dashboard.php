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
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Kode Klasifikasi Surat</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $klasifikasi ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Data Pejabat</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pejabat ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-solid fa-briefcase fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Data User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $users ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="col-lg">
                <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>Permintaan Nomor Surat
                </div>
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
                                        <?php if ($n->status_verifikasi == 'Sudah') { ?>

                                        <?php } else { ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= $n->sifat ?></td>
                                                <td><?php if ($n->status_verifikasi == 'Belum') { ?>
                                                        <a class="btn btn-sm btn-danger text-center" href="<?= base_url('Admin/Setujui/' . $n->id_nomor) ?>">
                                                            Setujui
                                                        </a>
                                                    <?php } elseif ($n->status_verifikasi == 'Tolak') { ?>
                                                        <p class="text-danger">Ditolak, Perbaiki !</p>
                                                        <a class="btn btn-sm btn-danger text-center" href="<?= base_url('Admin/Setujui/' . $n->id_nomor) ?>">
                                                            Setujui
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                                </td>
                                                <td><?= $n->tujuan_surat ?></td>
                                                <td><?= $n->perihal ?></td>
                                                <td><?= date('d-m-Y', strtotime($n->tanggal_surat)); ?></td>
                                                <td><?= $n->jabatan ?></td>
                                                <td class="text-center">
                                                    <i class="fas fa-exclamation"></i>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-warning text-dark" href="<?= base_url('Admin/detailNomor/' . $n->id_nomor) ?>">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
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