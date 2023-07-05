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
            Selamat datang di Sistem Informasi Manajemen Penggajian Karyawan SD NEGERI SIDOREJO
        </p>
    </div>
</div>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Data Karyawan</h3>
        </div>
        <div class="panel-body">
            <div class="row m-b-10">
                <div class="col-md-2">Nama</div>
                <div class="col-md-1">:</div>
                <div class="col-md-9"><?= session()->get('nama') ?></div>
            </div>
            <div class="row m-b-10">
                <div class="col-md-2">NIP</div>
                <div class="col-md-1">:</div>
                <div class="col-md-9"><?= session()->get('nip') ?></div>
            </div>
            <div class="row m-b-10">
                <div class="col-md-2">Jabatan</div>
                <div class="col-md-1">:</div>
                <div class="col-md-9"><?= session()->get('nama_jabatan') ?></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>