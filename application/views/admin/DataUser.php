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
            <a class="btn btn-sm btn-success mb-3" href="<?= base_url('Admin/tambah_dataUsers/') ?>">
                <i class="fas fa-plus"></i>Tambah Data
            </a>

            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">NIP</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Foto Profil</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                <?php $no = 1;
                foreach ($users as $u) : ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $u->nama ?></td>
                        <td><?= $u->nip ?></td>
                        <td><?= $u->jabatan ?></td>
                        <td><?= $u->email ?></td>
                        <td><?= $u->role ?></td>
                        <td class="text-center"><img src="<?= base_url() . 'assets/img/profile/' . $u->photo ?>" width="70px"></td>
                        <td class="text-center">
                            <?php if ($u->aktivasi == 'Aktif') { ?>
                                <div class="bg-warning text-dark"><?= $u->aktivasi ?></div>
                            <?php } else { ?>
                                <div class="bg-secondary text-white"><?= $u->aktivasi ?></div>
                            <?php } ?>
                        </td>

                        <td>
                            <center>
                                <a class="btn btn-sm btn-primary" href="<?= base_url('Admin/updateUsers/' . $u->id_user) ?>">
                                    <i class="fas fa-edit"> Edit</i>
                                </a>
                            </center>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>