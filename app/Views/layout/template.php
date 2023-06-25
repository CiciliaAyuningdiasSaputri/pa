<?= $this->include('layout/head') ?>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <?= $this->include('layout/header') ?>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <?= $this->include('layout/sidebar') ?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <?= $this->renderSection('content') ?>
                </div> <!-- container -->

            </div> <!-- content -->

            <!-- <footer class="footer text-right">
                2016 - 2018 © Zircos theme by Coderthemes.
            </footer> -->

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->



    <script>
    var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="<?= base_url() ?>/template/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/detect.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/fastclick.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/jquery.blockUI.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/waves.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/switchery/switchery.min.js"></script>

    <!-- Counter js  -->
    <script src="<?= base_url() ?>/template/plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/counterup/jquery.counterup.min.js"></script>

    <!--Morris Chart-->
    <!-- <script src="<?= base_url() ?>/template/plugins/morris/morris.min.js"></script> -->
    <script src="<?= base_url() ?>/template/plugins/raphael/raphael-min.js"></script>

    <!-- Dashboard init -->
    <!-- <script src="<?= base_url() ?>/template/assets/pages/jquery.dashboard.js"></script> -->

    <!-- App js -->
    <script src="<?= base_url() ?>/template/assets/js/jquery.core.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/jquery.app.js"></script>

    <!-- DataTables -->
    <script src="<?= base_url() ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.bootstrap.js"></script>

    <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/jszip.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/responsive.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.scroller.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.colVis.js"></script>
    <script src="<?= base_url() ?>/template/plugins/datatables/dataTables.fixedColumns.min.js"></script>

    <!-- init -->
    <script src="<?= base_url() ?>/template/assets/pages/jquery.datatables.init.js"></script>

    <?= $this->renderSection('script') ?>
</body>

</html>