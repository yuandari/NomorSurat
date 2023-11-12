                <!-- Footer -->
                <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->
                </div>

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>
                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">Apakah yakin akan logout ?</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                <a class="btn btn-primary" href="<?= base_url('Login/logout') ?>">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bootstrap core JavaScript-->
                <script src="<?= base_url('assets/') ?>jquery/jquery.min.js"></script>
                <script src="<?= base_url('assets/') ?>bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="<?= base_url('assets/') ?>jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="<?= base_url('assets/') ?>js/surat.min.js"></script>
                <!-- Custom scripts for input file-->
                <script>
                    $('.custom-file-input').on('change', function() {
                        let fileName = $(this).val().split('\\').pop();
                        $(this).next('.custom-file-label').addClass("selected").html(fileName);
                    });
                </script>

                <!-- Page level plugins -->
                <script src="<?= base_url('assets/') ?>chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
                <script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>
                <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                <script src="<?= base_url('assets/') ?>js/surat.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
                <script src="<?= base_url('assets/') ?>js/demo/datatables-demo.js"></script>

                </body>

                </html>