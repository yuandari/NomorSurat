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

            <a class="btn btn-sm btn-success mb-3" href=" <?= base_url('Pegawai/tambah_nmr/') ?>">
                <i class="fas fa-plus"> </i> Ajukan Nomor
            </a>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                </div>
                <div class="card-body">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-colums">
                        <!-- <div class="datatable-top">
                            <div class="datatable-dropdown">
                                <label for="">
                                    <select class="datatable-selector">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>
                                    "entries per page"
                                </label>
                            </div>
                            <div class="datatable-search">
                                <input class="datatable-input" placeholder="Search..." type="search" title="Search within table" aria-controls="datatablesSimple">
                            </div>
                            ::after
                        </div> -->
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
                                    foreach ($nomor as $n) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $n->sifat ?></td>
                                            <td><?php if ($n->status_verifikasi == 'Sudah') { ?>
                                                    <p><?= $n->nomor ?></p>
                                                <?php } elseif ($n->status_verifikasi == 'Tolak') { ?>
                                                    <p class="text-danger">Permintaan ditolak ! <br> Perbaiki !</p>
                                                <?php } else { ?>
                                                    <p class="text-danger">Silahkan Menghubungi Sekretaris!!</p>
                                                <?php } ?>
                                            </td>
                                            <td><?= $n->tujuan_surat ?></td>
                                            <td><?= $n->perihal ?></td>
                                            <td><?= date('d/m/Y', strtotime($n->tanggal_surat)); ?></td>
                                            <td><?= $n->jabatan ?></td>
                                            <td class="text-center">
                                                <?php if ($n->file_surat == true) { ?>
                                                    <a class="fas fa-solid fa-file-pdf" style="color: #2160f2;" target="_blank" href="<?= base_url() . 'assets/file/' . $n->file_surat ?>"></a>
                                                <?php } else { ?>
                                                    <?php if ($n->status_verifikasi == 'Sudah') { ?>
                                                        <?php if ($n->id_user == $user['id_user']) { ?>
                                                            <a class="btn btn-sm bg-secondary text-white" href="<?= base_url('Pegawai/uploadSurat/' . $n->id_nomor) ?>">
                                                                Upload
                                                            </a>
                                                        <?php } else { ?>
                                                            <i class="fas fa-regular fa-circle-xmark"></i>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <i class="fas fa-regular fa-circle-xmark"></i>
                                                    <?php } ?>
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