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

            <a class="btn btn-sm btn-warning mb-3" href="<?= base_url('Admin/DataUser') ?>">
                <i class="fas fa-regular fa-circle-left"> </i> Kembali
            </a>

            <div class="card" style="width: 100%">
                <div class="card-body">
                    <form method="POST" action="<?= base_url('Admin/tambah_aksiUsers/') ?>">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama'); ?>">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" value="<?= set_value('nip'); ?>" disabled>
                            <span class="text-danger text-xs">NIP harus terdiri dari 18 angka</span>
                            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>

                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?= set_value('jabatan'); ?>" disabled>
                            <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>" disabled>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Password </label>
                            <input type="password" class="form-control" name="password1" id="password1" disabled>
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Ulangi Password</label>
                            <input type="password" class="form-control" name="password2" id="password2" disabled>
                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-sm-3 col-form-label text-left">Role</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="role1" name="role" value="Admin" disabled>
                                <label class="form-check-label" for="role">Admin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="role2" name="role" value="Pegawai" disabled>
                                <label class="form-check-label" for="role">Pegawai</label>
                                <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="aktivasi" class="col-sm-3 col-form-label text-left">Aktivasi User</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="aktivasi1" name="aktivasi" value="Aktif">
                                <label class="form-check-label" for="aktivasi">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="aktivasi2" name="aktivasi" value="Tidak Aktif">
                                <label class="form-check-label" for="aktivasi">Tidak Aktif</label>
                                <?= form_error('aktivasi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div> -->

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-12 text-right">
                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- <div id="customAlert" class="custom-alert">
                        <span id="alertText"></span>
                        <span id="closeButton" class="close-button">&times;</span>
                    </div> -->
                </div>
            </div>
        </div><br><br>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const nama = document.getElementById("nama");
                const nip = document.getElementById("nip");
                const jabatan = document.getElementById("jabatan");
                const email = document.getElementById("email");
                const password1 = document.getElementById("password1");
                const password2 = document.getElementById("password2");
                const role1 = document.getElementById('role1');
                const role2 = document.getElementById('role2');
                // const aktivasi = document.querySelectorAll('input[name="aktivasi"]');
                const submit = document.getElementById("submit");

                // //fungsi menampilkan alert
                // function showAlert(message) {
                //     const customAlert = document.getElementById("customAlert");
                //     const alertText = document.getElementById("alertText");

                //     alertText.textContent = message;
                //     customAlert.style.display = "block";

                //     //sembunyikan alert tanpa tutup  klik
                //     const closebutton = document.getElementById("closeButton");
                //     closebutton.addEventListener("click", function() {
                //         customAlert.style.display = "none";
                //     });
                // }

                // Fungsi untuk memerikasa apakah input 1 diisi
                function checkInput1() {
                    if (nama.value.trim() !== "") {
                        nip.removeAttribute("disabled");
                    } else {
                        nip.setAttribute("disabled", "disabled");
                        submit.setAttribute("disabled", "disabled");
                    }
                }
                // Fungsi untuk memerikasa apakah input 2 diisi
                function checkInput2() {
                    const inputValue = nip.value.trim();
                    const errorElement = document.getElementById("nipError");
                    if (inputValue === "") {
                        //Jika input kosong, tidak perlu validasi
                        errorElement.textContent = "";
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
                            // errorElement.textContent = "NIP tidak sesuai ketentuan";
                            alert("NIP tidak sesuai ketentuan");
                        }
                    } else if (!/^\d+$/.test(inputValue)) {
                        jabatan.setAttribute("disabled", "disabled");
                        jabatan.value = "";
                        submit.setAttribute("disabled", "disabled");
                        alert("NIP harus berupa angka");
                        // errorElement.textContent = "NIP harus berupa angka";
                    } else {
                        jabatan.setAttribute("disabled", "disabled");
                        jabatan.value = "";
                        submit.setAttribute("disabled", "disabled");
                    }
                }

                // Fungsi untuk memerikasa apakah input 3 diisi
                function checkInput3() {
                    if (jabatan.value.trim() !== "") {
                        email.removeAttribute("disabled");
                    } else {
                        email.setAttribute("disabled", "disabled");
                    }
                }

                // Fungsi untuk memerikasa apakah input 4 diisi
                function checkInput4() {
                    if (email.value.trim() !== "") {
                        password1.removeAttribute("disabled");
                    } else {
                        password1.setAttribute("disabled", "disabled");
                    }
                }

                // Fungsi untuk memerikasa apakah input 5 diisi
                function checkInput5() {
                    if (password1.value.trim() !== "") {
                        password2.removeAttribute("disabled");
                    } else {
                        password2.setAttribute("disabled", "disabled");
                    }
                }

                // Fungsi untuk memerikasa apakah input 5 diisi
                function checkInput6() {
                    if (password2.value.trim() !== "") {
                        role1.removeAttribute("disabled");
                        role2.removeAttribute("disabled");
                    } else {
                        role1.setAttribute("disabled", "disabled");
                        role2.setAttribute("disabled", "disabled");

                        //Pastikan juga radio button tidak dipilih jika dinonaktifkan
                        role1.checked = false;
                        role2.checked = false;
                    }
                }

                // //Fungsi untuk menonaktifkan elemen-elemen radio button dalam sebuah group
                // function disableRadioButtons(radioButtons) {
                //     radioButtons.forEach(radio => {
                //         radio.setAttribute("disabled", "disabled");
                //     });
                // }

                // //Fungsi untuk mengaktifkan lemen-elemen radio button dalam sebuah group
                // function enableRadioButtons(radioButtons) {
                //     radioButtons.forEach(radio => {
                //         radio.removeAttribute("disabled");
                //     });
                // }

                // Fungsi untuk memeriksa apakah semua input telah diisi
                function checkInputs() {
                    const allInputsFilled = [...document.querySelectorAll("input[type='text']")].every(input => input.value.trim() !== "");
                    if (allInputsFilled && (role1.checked || role2.checked)) {
                        submit.removeAttribute("disabled");
                    } else {
                        submit.setAttribute("disabled", "disabled");
                    }
                }

                // Tambahkan event listener untuk input 1
                nama.addEventListener("input", function() {
                    checkInput1();
                    checkInputs();
                });

                // Tambahkan event listener untuk input 2
                nip.addEventListener("input", function() {
                    checkInput2();
                    checkInputs();
                });
                // Tambahkan event listener untuk input 3
                jabatan.addEventListener("input", function() {
                    checkInput3();
                    checkInputs();
                });
                // Tambahkan event listener untuk input 4
                email.addEventListener("input", function() {
                    checkInput4();
                    checkInputs();
                });
                // Tambahkan event listener untuk input 5
                password1.addEventListener("input", function() {
                    checkInput5();
                    checkInputs();
                });
                // Tambahkan event listener untuk input 6
                password2.addEventListener("input", function() {
                    checkInput6();
                    checkInputs();
                });

                //Tambahkan event listener untuk radio button 1
                [role1, role2].forEach(radio => {
                    radio.addEventListener("change", checkInputs);
                });

                // //Tambahkan event listener untuk radio button 2
                // aktivasi.forEach(radio => {
                //     radio.addEventListener("change", checkInputs);
                // });

                //panggil fungsi checkInput1 untuk memeriksa status awal
                checkInput1();
                checkInput2();
                checkInput3();
                checkInput4();
                checkInput5();
                checkInput6();
                checkInputs();
            });

            // document.getElementById("nip").addEventListener("input", function() {
            //     if (this.value.length > 18) {
            //         alert("Panjang karakter maksimum adalah 18");
            //         this.value = this.value.slice(0, 18);
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
        </script>

    </main>