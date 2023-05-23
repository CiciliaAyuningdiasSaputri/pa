<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= base_url() ?>/<?= session()->get('role') ?>/dashboard">Dashboard</a>
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="panel panel-default panel-border">
    <div class="panel-heading">
        <h3 class="panel-title">Hi, <?= session()->get('nama') ?>!</h3>
    </div>
    <div class="panel-body">
        <p>
            Selamat datang di Sistem Informasi Manajemen Penggajian Karyawan
        </p>
    </div>
</div>
<div class="col-lg-3 col-md-6" bis_skin_checked="1">
    <a href="<?= site_url('kepsek/laporan') ?>">
        <div class="card-box widget-box-two widget-two-primary" bis_skin_checked="1">
            <i class="mdi mdi-chart-areaspline widget-two-icon"></i>
            <div class="wigdet-two-content" bis_skin_checked="1">
                <h2><span data-plugin="">Laporan</span> <small>
                <p class="text-muted m-0"><b>Data Gaji</b></p>
            </div>
        </div>
    </a>
</div>
<?= $this->endSection() ?>