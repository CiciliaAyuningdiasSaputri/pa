<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= base_url() ?>/admin/dashboard">Dashboard</a>
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="panel panel-default panel-border">
    <div class="panel-heading">
        <h3 class="panel-title">Hi, Admin!</h3>
    </div>
    <div class="panel-body">
        <p>
        Selamat datang di Sistem Informasi Manajemen Penggajian Karyawan SD Negeri Sidorejo
        </p>
    </div>
</div>
<?= $this->endSection() ?>