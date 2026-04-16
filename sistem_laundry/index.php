<?php     
    require_once 'config/functions_fetch.php';
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header('Location: login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Laundry - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/vendor/toastr/toastr.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'partials/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'partials/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php 
                        $pathPages = 'pages/'. $page . '.php'; 

                        if (file_exists($pathPages)) {
                            include ($pathPages);
                        } else {
                            include 'pages/404.php';
                        }
                    ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'partials/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" jika anda ingin keluar dari dashboard</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="controllers/penggunaController.php?proses=logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

     <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>
    <script src="assets/vendor/toastr/toastr.min.js"></script>

    <script>
        $('#exampleModalEditPelanggan').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)

            let id = button.data('id')
            let nama = button.data('nama')
            let noTelp = button.data('telp')
            let alamat = button.data('alamat')
            let modal = $(this)

            modal.find('#id').val(id)
            modal.find('#nama').val(nama)
            modal.find('#noTelp').val(noTelp)
            modal.find('#alamat').val(alamat)
        })

        $('#exampleModalEditLayanan').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)

            let id = button.data('id')
            let nama_layanan = button.data('nama_layanan')
            let harga = button.data('harga')
            let modal = $(this)

            modal.find('#id').val(id)
            modal.find('#layanan').val(nama_layanan)
            modal.find('#harga').val(harga)
        })

        $('#exampleModalEditTransaksi').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)

            let id = button.data('id')
            let pelanggan = button.data('nama')
            let layanan = button.data('layanan')
            let berat = button.data('berat')
            let tanggal = button.data('tanggal')
            let status = button.data('status')
            let modal = $(this)

            modal.find('#id').val(id)
            modal.find('#pelanggan').val(pelanggan)
            modal.find('#layanan').val(layanan)
            modal.find('#berat').val(berat)
            modal.find('#tanggal').val(tanggal)
            modal.find('#status').val(status)
        })

        $('#exampleModalEditPengguna').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)

            let id = button.data('id')
            let nama = button.data('nama_pengguna')
            let email = button.data('email')
            let username = button.data('username')
            let modal = $(this)

            modal.find('#id').val(id)
            modal.find('#nama_pengguna').val(nama)
            modal.find('#email').val(email)
            modal.find('#username').val(username)
        })

        $('#exampleModalEditPassword').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)
            let id = button.data('id_pass')
            let modal = $(this)

            modal.find('#id_pass').val(id)
        })

        <?php if (isset($_SESSION['pesan']) && isset($_SESSION['status'])) : ?>
            toastr.<?= $_SESSION['status']; ?>('<?= $_SESSION['pesan']; ?>')
        <?php 
            unset($_SESSION['pesan']);
            unset($_SESSION['status']);
            endif; 
        ?>

    </script>

</body>

</html>