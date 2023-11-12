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
            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Admin/DataPejabat') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">
                    <form method="POST" action="<?= base_url('Admin/tambah_aksipj/') ?>">
                        <div class="form-group">
                            <label>Nama Pejabat</label>
                            <input type="text" class="form-control" name="nama_pejabat" id="nama_pejabat" value="<?= set_value('nama_pejabat'); ?>">
                            <?= form_error('nama_pejabat', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" value="<?= set_value('nip'); ?>" disabled>
                            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?= set_value('jabatan'); ?>" disabled>
                            <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

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
                const nama_pejabat = document.getElementById("nama_pejabat");
                const nip = document.getElementById("nip");
                const jabatan = document.getElementById("jabatan");
                const submit = document.getElementById("submit");

                // Fungsi untuk memerikasa apakah input 1 diisi
                function checkInput1() {
                    if (nama_pejabat.value.trim() !== "") {
                        nip.removeAttribute("disabled");
                    } else {
                        nip.setAttribute("disabled", "disabled");
                    }
                }

                // Fungsi untuk memerikasa apakah input 2 diisi
                function checkInput2() {
                    const inputValue = nip.value.trim();
                    if (inputValue === "") {
                        //Jika input kosong, tidak perlu validasi
                        return;
                    }
                    if (inputValue.length >= 18) {
                        //cek apakah nip berupa angka dan memiliki panjang 18 karakter
                        if (/^\d+$/.test(inputValue) && inputValue.length === 18) {
                            jabatan.removeAttribute("disabled");
                        } else {
                            jabatan.setAttribute("disabled", "disabled");
                            jabatan.value = "";
                            submit.setAttribute("disabled", "disabled");
                            alert("NIP tidak sesuai ketentuan");
                        }
                    } else if (!/^\d+$/.test(inputValue)) {
                        jabatan.setAttribute("disabled", "disabled");
                        jabatan.value = "";
                        submit.setAttribute("disabled", "disabled");
                        alert("NIP harus berupa angka");
                    } else {
                        jabatan.setAttribute("disabled", "disabled");
                        jabatan.value = "";
                        submit.setAttribute("disabled", "disabled");
                    }
                }
                // Fungsi untuk memeriksa apakah semua input telah diisi
                function checkInputs() {
                    const allInputsFilled = [...document.querySelectorAll("input[type='text']")].every(input => input.value.trim() !== "");

                    if (allInputsFilled) {
                        submit.removeAttribute("disabled");
                    } else {
                        submit.setAttribute("disabled", "disabled");
                    }
                }

                // Tambahkan event listener untuk input 1
                nama_pejabat.addEventListener("input", function() {
                    checkInput1();
                    checkInputs();
                });

                // Tambahkan event listener untuk input 2
                nip.addEventListener("input", function() {
                    checkInput2();
                    checkInputs();
                });

                //Tambahkan event listener untuk input 3
                jabatan.addEventListener("input", checkInputs);

                //panggil fungsi checkInput1 untuk memeriksa status awal
                checkInput1();
                checkInput2();
                checkInputs();
            });

            // var inputField = document.getElementById("nip");
            // inputField.addEventListener("input", function() {
            //     if (this.value.length >= 18) {
            //         this.value = this.value.substring(0, 18);
            //         this.setAttribute("readonly", "readonly");
            //     } else {
            //         this.removeAttribute("readonly");
            //     }
            // });

            document.getElementById("nip").addEventListener("keydown", function(event) {
                if (this.value.length >= 18 && event.key !== "Backspace") {
                    event.preventDefault();
                    alert("Panjang karakter maksimum adalah 18");
                }
            });

            document.getElementById("nip").addEventListener("input", function() {
                var input = this.value;
                if (/[^0-9]/.test(input)) {
                    alert("NIP hanya angka yang diperbolehkan");
                    this.value = input.replace(/[^0-9]/g, ''); //Hapus karakter yang tidak valid
                }
            });

            // document.getElementById("nip").addEventListener("keydown", function(event) {
            //     if (this.value.length >= 18 && event.key !== "Backspace") {
            //         event.preventDefault();
            //     }
            // });

            // function limitInput(element, maxLength) {
            //     if (element.value.length > maxLength) {
            //         element.value = element.value.slice(0, maxLength);
            //     }
            // }
        </script>
    </main>