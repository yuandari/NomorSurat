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

            <div class="card mb-3" style="max-width: 700px;">

                <div class="col-12">
                    <div class="card-body">
                        <?php foreach ($nomor as $n) : ?>

                            <table class="table table-striped" style="margin:0;font-size:13px">
                                <tbody>
                                    <tr>
                                        <td style="padding-bottom:2px;" width="180px">Sifat</td>
                                        <td style="padding-bottom:2px;"><?= $n->sifat ?></td>
                                        <td style="padding-bottom:2px;">Tanggal Surat</td>
                                        <td style="padding-bottom:2px;"><?= date('d-m-Y', strtotime($n->tanggal_surat));  ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:2px;">No Surat</td>
                                        <td style="padding-bottom:2px;">
                                            <?php if ($n->status_verifikasi == 'Sudah') { ?>
                                                <?= $n->nomor ?>
                                            <?php } else { ?>
                                                <p class="text-danger">Silahkan Menghubungi Sekretaris!!</p>
                                            <?php } ?>
                                        </td>
                                        <td style="padding-bottom:2px;">Tanggal Input</td>
                                        <td style="padding-bottom:2px;"><?= date('d-m-Y', strtotime($n->created_at));  ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:2px;">Tujuan Surat</td>
                                        <td style="padding-bottom:2px;" colspan="3"><?= $n->tujuan_surat ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:2px;">Perihal</td>
                                        <td style="padding-bottom:0px;" colspan="3"><?= $n->perihal ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:2px;">Pejabat Penandatangan</td>
                                        <td style="padding-bottom:0px;" colspan="3"><?= $n->jabatan ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:2px;">Petugas Input</td>
                                        <td style="padding-bottom:0px;" colspan="3"><?= $n->nama ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:2px;">Jenis Arsip</td>
                                        <td style="padding-bottom:0px;" colspan="3"><?= $n->jenis_arsip ?></td>
                                    </tr>

                                </tbody>
                            </table><br>
                            <?php if ($n->file_surat == true) { ?>
                                <object width="650px" height="970px" data="<?= base_url() . 'assets/file/' . $n->file_surat ?>" type="application/pdf"></object>
                            <?php } else { ?>
                                <p class="text-danger">File Surat belum tersedia !</p>
                            <?php } ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </main>