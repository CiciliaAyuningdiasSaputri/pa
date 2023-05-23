<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>/template/assets/images/favicon.ico">
    <!-- App title -->
    <title>Sistem Informasi Penggajian Karyawan</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/morris/morris.css">

    <!-- App css -->
    <link href="<?= base_url() ?>/template/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/switchery/switchery.min.css">

    <!-- DataTables -->
    <link href="<?= base_url() ?>/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/template/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />

    <script src="<?= base_url() ?>/template/assets/js/modernizr.min.js"></script>

    <!-- Add On CSS/Script -->
    <?= $this->renderSection('css-script') ?>
</head>