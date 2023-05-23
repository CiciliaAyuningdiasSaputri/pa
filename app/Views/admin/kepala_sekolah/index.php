<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Data Kepala Sekolah</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= site_url('admin/dashboard') ?>">Admin</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>/admin/kepala_sekolah">Kepala Sekolah</a>
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="card-box">
    <div class="row">
        <div class="col-sm-6" bis_skin_checked="1">
            <div class="row m-b-10">
                <strong>
                    <div class="col-sm-2">NIP</div>
                    <div class="col-sm-1">:</div>
                </strong>
                <div class="col-sm-9">
                    <?= $kepsek['nip'] ?>
                </div>
            </div>
            <div class="row m-b-10">
                <strong>
                    <div class="col-sm-2">NAMA</div>
                    <div class="col-sm-1">:</div>
                </strong>
                <div class="col-sm-9">
                    <?= $kepsek['nama'] ?>
                </div>
            </div>
            <div class="row m-b-10">
                <strong>
                    <div class="col-sm-2">JENIS KELAMIN</div>
                    <div class="col-sm-1">:</div>
                </strong>
                <div class="col-sm-9">
                    <?= $kepsek['jenis_kelamin'] == 'l' ? 'Laki-laki' : 'Perempuan' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-3 col-sm-9">
                    <a href="<?= site_url('admin/kepala_sekolah/edit/') ?>" class="btn btn-info waves-effect waves-light">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {})
</script>
<?= $this->endSection() ?>