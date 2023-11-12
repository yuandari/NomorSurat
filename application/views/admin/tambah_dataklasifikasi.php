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
            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Admin/DataKlasifikasi') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">
                    <form method="POST" action="<?= base_url('Admin/tambah_aksikl/') ?>">
                        <div class="form-group">
                            <label>Kode Klasifikasi</label>
                            <input type="text" class="form-control" name="kode_klasifikasi" id="kode_klasifikasi">
                            <?= form_error('kode_klasifikasi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jenis Arsip</label>
                            <input type="text" class="form-control" name="jenis_arsip" id="jenis_arsip" disabled>
                            <?= form_error('jenis_arsip', '<small class="text-danger pl-3">', '</small>'); ?>
                            <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $user['id_user'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="persetujuan" class="col-sm-3 col-form-label text-left">Persetujuan</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="persetujuan1" name="persetujuan" value="Ya" disabled>
                                <label class="form-check-label" for="persetujuan">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="persetujuan2" name="persetujuan" value="Tidak" disabled>
                                <label class="form-check-label" for="persetujuan">Tidak</label>
                            </div>
                            <?= form_error('persetujuan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-12 text-right">
                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const kode_klasifikasi = document.getElementById("kode_klasifikasi");
                const jenis_arsip = document.getElementById("jenis_arsip");
                const persetujuan1 = document.getElementById("persetujuan1");
                const persetujuan2 = document.getElementById("persetujuan2");
                const submit = document.getElementById("submit");

                // Fungsi untuk memerikasa apakah input 1 diisi
                function checkInput1() {
                    if (kode_klasifikasi.value.trim() !== "") {
                        jenis_arsip.removeAttribute("disabled");
                        persetujuan1.removeAttribute("disabled");
                        persetujuan2.removeAttribute("disabled");
                    } else {
                        jenis_arsip.setAttribute("disabled", "disabled");
                        persetujuan1.setAttribute("disabled", "disabled");
                        persetujuan2.setAttribute("disabled", "disabled");

                        //Pastikan juga radio button tidak dipilih jika dinonaktifkan
                        persetujuan1.checked = false;
                        persetujuan2.checked = false;
                    }
                }

                // // Fungsi untuk memerikasa apakah input 2 diisi
                // function checkInput2() {
                //     if (jenis_arsip.value.trim() !== "") {
                //         persetujuan.removeAttribute("disabled");
                //     } else {
                //         persetujuan.setAttribute("disabled", "disabled");
                //     }
                // }

                // Fungsi untuk memeriksa apakah semua input telah diisi
                function checkInputs() {
                    const allInputsFilled = [kode_klasifikasi, jenis_arsip].every(input => input.value.trim() !== "");

                    if (allInputsFilled && (persetujuan1.checked || persetujuan2.checked)) {
                        submit.removeAttribute("disabled");
                    } else {
                        submit.setAttribute("disabled", "disabled");
                    }
                }

                // Tambahkan event listener untuk input 1
                kode_klasifikasi.addEventListener("input", function() {
                    checkInput1();
                    checkInputs();
                });

                // // Tambahkan event listener untuk input 2
                // jenis_arsip.addEventListener("input", function() {
                //     checkInput2();
                //     checkInputs();
                // });

                //Tambahkan event listener untuk radio button
                [persetujuan1, persetujuan2].forEach(radio => {
                    radio.addEventListener("change", checkInputs);
                });

                //panggil fungsi checkInput1 untuk memeriksa status awal
                checkInput1();
                // checkInput2();
                checkInputs();
            });
        </script>

    </main>