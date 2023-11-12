<div id="layoutSidenav_content">
    <main>
        <!-- Page Heading -->
        <!-- <div class="d-sm-flex align-items-center justify-content-between mb-3"> -->
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?= $title ?></h4>
            <!-- </div> -->
            <div class="mb-4">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="card mb-4" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 pt-4 pl-4">
                        <img src="<?= base_url('assets/img/profile/') . $user['photo'] ?>" class=" img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title"><?= $user['nama'] ?></h4>
                            <table>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td class="card-text"><?= $user['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>:</td>
                                    <td class="card-text"><?= $user['nip'] ?></td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td class="card-text"><?= $user['jabatan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td class="card-text"><?= $user['role'] ?></td>
                                </tr>

                            </table>
                            <p class="card-text"><small class="text-body-secondary">Akun sejak <?= date('d F Y', strtotime($user["created_at"]));  ?></small></p>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-12 text-right">
                                    <a class="btn btn-sm btn-success mb-2" href="<?= base_url('Admin/edit_profile') ?>">
                                        Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>