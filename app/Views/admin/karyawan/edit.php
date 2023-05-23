<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Edit Karyawan</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= base_url() ?>/admin/karyawan">Karyawan</a>
                </li>
                <li>
                    Edit Karyawan
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="card-box table-responsive">
    <div class="row">
        <?php
        if (isset($error)) {
            print_r($error);
            die();
        }
        ?>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
        <div class="col-md-6">
            <form class="form-horizontal" action="<?= site_url('admin/karyawan/update/' . $karyawan['id']) ?>" method="POST">
                <div class="form-group">
                    <label class="col-md-2 control-label">NIP</label>
                    <div class="col-md-10">
                        <input type="text" placeholder="" id="nip" data-mask="99999999 999999 9 999" name="nip" value="<?= set_value('nip', $karyawan['nip']) ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Username</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= set_value('username', $karyawan['username']) ?>" readonly required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Nama</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= set_value('nama', $karyawan['nama']) ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Jenis Kelamin</label>
                    <div class="col-md-10">
                        <div class="radio radio-info radio-inline" bis_skin_checked="1">
                            <input type="radio" id="jenis_kelamin1" value="l" name="jenis_kelamin" <?php if ($karyawan['jenis_kelamin'] == "l") {
                                                                                                        echo 'checked';
                                                                                                    } ?> required>
                            <label for="jenis_kelamin1"> Laki-laki </label>
                        </div>
                        <div class="radio radio-info radio-inline" bis_skin_checked="1">
                            <input type="radio" id="jenis_kelamin2" value="p" name="jenis_kelamin" <?php if ($karyawan['jenis_kelamin'] == "p") {
                                                                                                        echo 'checked';
                                                                                                    } ?> required>
                            <label for="jenis_kelamin2"> Perempuan </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="jabatan_id" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <?php
                            echo $jabatan_list;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-teal waves-effect waves-light">Submit</button>
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
    var table
    $(document).ready(function() {
        $('#nip').focus()
    })
</script>
<?= $this->endSection() ?>