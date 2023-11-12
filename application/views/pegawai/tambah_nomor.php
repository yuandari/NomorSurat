<?php
$a = ($kode['max_code']) ?? 000;
$b = $jenis['kode_klasifikasi'];
$c = $jenis['id_klasifikasi'];
$d = $jenis['jenis_arsip'];
$e = $jenis['persetujuan'];
$tahun = date('Y');

//ya
$urutana = (int)substr($a, -3);
$urutana++;
$kda = $b . '-Aw/' . sprintf("%03s", $urutana);
//Tidak
$urutanb = (int)substr($a, 0, 3);
$urutanb++;
$kdb = sprintf("%03s", $urutanb) . '/' . $b . '/Aw/' . $tahun;

?>

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
            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Pegawai/tambah_nmr/') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">
                    <form method="POST" action="<?= base_url('Pegawai/tambah_aksiNmr') ?>">
                        <div class="form-group row" hidden>
                            <label for="nomor" class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <?php if ($e == 'Ya') { ?>
                                    <input type="text" class="form-control" id="nomor" name="nomor" value="<?= $kda; ?>" readonly>
                                <?php } else { ?>
                                    <input type="text" class="form-control" id="nomor" name="nomor" value="<?= $kdb; ?>" readonly>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_klasifikasi" class="col-sm-3 col-form-label">Jenis Arsip</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="klasifikasi" name="klasifikasi" value="<?= $d; ?>" readonly>
                                <input type="text" class="form-control" id="id_klasifikasi" name="id_klasifikasi" value="<?= $c; ?>" readonly hidden>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sifat" class="col-sm-3 col-form-label">Sifat</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="sifat" id="sifat">
                                    <option value="">--Pilih Sifat Surat--</option>
                                    <option value="Biasa">Biasa</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Terbuka">Terbuka</option>
                                    <option value="Terbatas">Terbatas</option>
                                    <option value="Rahasia">Rahasia</option>
                                    <option value="Segera">Segera</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tujuan_surat" class="col-sm-3 col-form-label">Tujuan Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tujuan_surat" name="tujuan_surat" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="perihal" name="perihal" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_pejabat" class="col-sm-3 col-form-label">Pejabat Penandatangan</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="id_pejabat" id="id_pejabat" required disabled>
                                    <option value="">--Pilih Pejabat Penandatangan--</option>
                                    <?php foreach ($pejabat as $p => $value) { ?>
                                        <option value="<?= $value->id_pejabat ?>"><?= $value->jabatan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label for="status_verifikasi" class="col-sm-3 col-form-label">Status Verifikasi</label>
                            <div class="col-sm-9">
                                <?php if ($e == 'Ya') { ?>
                                    <input type="text" class="form-control" id="status_verifikasi" name="status_verifikasi" value="Belum" readonly>
                                <?php } else { ?>
                                    <input type="text" class="form-control" id="status_verifikasi" name="status_verifikasi" value="Sudah" readonly>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $user['id_user'] ?>">

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-12 text-right">
                                <button type="submit" id="submit" class="btn btn-primary" disabled>Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const sifat = document.getElementById("sifat");
                const tujuan_surat = document.getElementById("tujuan_surat");
                const perihal = document.getElementById("perihal");
                const tanggal_surat = document.getElementById("tanggal_surat");
                const id_pejabat = document.getElementById("id_pejabat");
                const submit = document.getElementById("submit");

                // Fungsi untuk memerikasa apakah input 1 diisi
                function checkInput1() {
                    if (sifat.value.trim() !== "") {
                        tujuan_surat.removeAttribute("disabled");
                    } else {
                        tujuan_surat.setAttribute("disabled", "disabled");
                        perihal.setAttribute("disabled", "disabled");
                        tanggal_surat.setAttribute("disabled", "disabled");
                        id_pejabat.setAttribute("disabled", "disabled");
                        tujuan_surat.value = "";
                        perihal.value = "";
                        tanggal_surat.value = "";
                        id_pejabat.value = "";
                        submit.setAttribute("disabled", "disabled");
                    }
                }
                // Fungsi untuk memerikasa apakah input 2 diisi
                function checkInput2() {
                    if (tujuan_surat.value.trim() !== "") {
                        perihal.removeAttribute("disabled");
                    } else {
                        perihal.setAttribute("disabled", "disabled");
                        tanggal_surat.setAttribute("disabled", "disabled");
                        id_pejabat.setAttribute("disabled", "disabled");
                        perihal.value = "";
                        tanggal_surat.value = "";
                        id_pejabat.value = "";
                        submit.setAttribute("disabled", "disabled");
                    }
                }

                // Fungsi untuk memerikasa apakah input 3 diisi
                function checkInput3() {
                    if (perihal.value.trim() !== "") {
                        tanggal_surat.removeAttribute("disabled");
                    } else {
                        tanggal_surat.setAttribute("disabled", "disabled");
                        id_pejabat.setAttribute("disabled", "disabled");
                        tanggal_surat.value = "";
                        id_pejabat.value = "";
                        submit.setAttribute("disabled", "disabled");
                    }
                }

                // Fungsi untuk memerikasa apakah input 4 diisi
                function checkInput4() {
                    if (tanggal_surat.value.trim() !== "") {
                        id_pejabat.removeAttribute("disabled");
                    } else {
                        id_pejabat.setAttribute("disabled", "disabled");
                        id_pejabat.value = "";
                        submit.setAttribute("disabled", "disabled");
                    }
                }
                // Fungsi untuk memerikasa apakah input 5 diisi
                function checkInput5() {
                    if (id_pejabat.value.trim() !== "") {
                        submit.removeAttribute("disabled");
                    } else {
                        submit.setAttribute("disabled", "disabled");
                    }
                }

                // // Fungsi untuk memeriksa apakah semua input telah diisi
                // function checkInputs() {
                //     const allInputsFilled = [...document.querySelectorAll("input[type='text']")].every(input => input.value.trim() !== "");

                //     if (allInputsFilled) {
                //         submit.removeAttribute("disabled");
                //     } else {
                //         submit.setAttribute("disabled", "disabled");
                //     }
                // }

                // Tambahkan event listener untuk input 1
                sifat.addEventListener("input", function() {
                    checkInput1();
                    checkInput2();
                    checkInput3();
                    checkInput4();
                    checkInput5();
                });

                // Tambahkan event listener untuk input 2
                tujuan_surat.addEventListener("input", function() {
                    checkInput2();
                    checkInput3();
                    checkInput4();
                    checkInput5();
                });
                // Tambahkan event listener untuk input 3
                perihal.addEventListener("input", function() {
                    checkInput3();
                    checkInput4();
                    checkInput5();
                });
                // Tambahkan event listener untuk input 4
                tanggal_surat.addEventListener("input", function() {
                    checkInput4();
                    checkInput5();
                });

                //Tambahkan event listener untuk input 5
                id_pejabat.addEventListener("input", checkInput5);

                //panggil fungsi checkInput1 untuk memeriksa status awal
                checkInput1();
                // checkInput2();
                // checkInput3();
                // checkInput4();
                // checkInput5();
            });
        </script>

    </main>