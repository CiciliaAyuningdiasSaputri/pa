<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Laporan</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= site_url('admin/dashboard') ?>">Admin</a>
                </li>
                <li>
                    Laporan
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="card-box">
    <div class="row">
        <div class="col-sm-6" bis_skin_checked="1">
            <form class="form-inline" id="formGajiFilter" action="<?= site_url('admin/laporan/cetak') ?>" method="POST">
                <div class="form-group m-r-10">
                    <label class="m-r-10" for="bulan">Bulan</label>
                    <select class="form-control" name="bulan" id="filter-bulan">
                        <option value="">-- Pilih Bulan--</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group m-r-10">
                    <label class="m-r-10" for="tahun">Tahun</label>
                    <select class="form-control" name="tahun" id="filter-tahun">
                        <option value="">-- Pilih Tahun--</option>
                        <?php
                        $tahunStart = 2020;
                        $tahun = date('Y');
                        for ($i = $tahunStart; $i <= $tahun; $i++) : ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor;
                        ?>
                    </select>
                </div>
                <button type="submit" id="btn-filter" class="btn btn-custom waves-effect waves-light btn-md">
                    Cetak Laporan
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {})
</script>
<?= $this->endSection() ?>