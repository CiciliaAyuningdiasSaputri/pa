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
            <form action="<?= site_url('admin/kepala_sekolah/update') ?>" method="POST">
                <div class="row m-b-30">
                    <strong>
                        <div class="col-sm-2">NIP</div>
                        <div class="col-sm-1">:</div>
                    </strong>
                    <div class="col-sm-9">
                        <input type="text" placeholder="" data-mask="99999999 999999 9 999" name="nip" id="nip" value="<?= set_value('nip', $kepsek['nip']) ?>" class="form-control">
                    </div>
                </div>
                <div class="row m-b-30">
                    <strong>
                        <div class="col-sm-2">NAMA</div>
                        <div class="col-sm-1">:</div>
                    </strong>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= set_value('nama', $kepsek['nama']) ?>" required>
                    </div>
                </div>
                <div class="row m-b-30">
                    <strong>
                        <div class="col-sm-2">JENIS KELAMIN</div>
                        <div class="col-sm-1">:</div>
                    </strong>
                    <div class="col-sm-9">
                        <div class="col-md-10">
                            <div class="radio radio-info radio-inline" bis_skin_checked="1">
                                <input type="radio" id="jenis_kelamin1" value="l" name="jenis_kelamin" <?php if ($kepsek['jenis_kelamin'] == "l") {
                                                                                                            echo 'checked';
                                                                                                        } ?> required>
                                <label for="jenis_kelamin1"> Laki-laki </label>
                            </div>
                            <div class="radio radio-info radio-inline" bis_skin_checked="1">
                                <input type="radio" id="jenis_kelamin2" value="p" name="jenis_kelamin" <?php if ($kepsek['jenis_kelamin'] == "p") {
                                                                                                            echo 'checked';
                                                                                                        } ?> required>
                                <label for="jenis_kelamin2"> Perempuan </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/template/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script>
    $(document).ready(function() {
        $('#nip').focus()
    })
</script>
<?= $this->endSection() ?>