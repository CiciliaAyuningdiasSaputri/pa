<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Edit Gaji</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= base_url() ?>/admin/gaji">Gaji</a>
                </li>
                <li>
                    Edit Gaji
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="card-box table-responsive">
    <div class="row">
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
            <form class="form-horizontal" action="<?= site_url('admin/gaji/update') ?>" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Karyawan</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id" value="<?= set_value('id', $gaji['id']) ?>" />
                        <input type="text" name="nama" class="form-control" value="<?= set_value('nama', $gaji['nama']) ?>" readonly />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Gaji Pokok</label>
                    <!-- <select class="form-control" name="gaji_pokok" id="filter-bulan">
                        <option value="<?= set_value('gaji_pokok', $gaji['gaji_pokok']) ?>">-- Pilih Rp--</option>
                        <option value="1.000.000">1.000.000.00</option>
                        <option value="1.100.000">1.100.000.00</option>
                        <option value="1.200.000">1.200.000.00</option>
                        <option value="1.300.000">1.300.000.00</option>
                        <option value="1.400.000">1.400.000.00</option>
                        <option value="1.500.000">1.500.000.00</option>
                    </select> -->
                    <div class="col-md-10">
                        <div class="input-group m-t-10" bis_skin_checked="1">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" placeholder=""  class="form-control autonumber" name="gaji_pokok" value="<?= set_value('gaji_pokok', $gaji['gaji_pokok']) ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Uang Makan</label>
                    <div class="col-md-10">
                        <div class="input-group m-t-10" bis_skin_checked="1">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" placeholder=""  class="form-control autonumber" name="uang_makan" value="<?= set_value('uang_makan', $gaji['uang_makan']) ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Uang Tambahan</label>
                    <div class="col-md-10">
                        <div class="input-group m-t-10" bis_skin_checked="1">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" placeholder=""  class="form-control autonumber" name="uang_tambahan" value="<?= set_value('uang_tambahan', $gaji['uang_tambahan']) ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Potongan</label>
                    <div class="col-md-10">
                        <div class="input-group m-t-10" bis_skin_checked="1">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" placeholder=""  class="form-control autonumber" name="potongan" value="<?= set_value('potongan', $gaji['potongan']) ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Gajian</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <?php 
                                $date = date('Y-m-d');
                            ?>
                            <!-- <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose"> -->
                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="tanggal_gajian" value="<?= set_value('tanggal_gajian', $gaji['tanggal_gajian']) ?>">
                            <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('css-script') ?>
<link href="<?= base_url() ?>/template/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/template/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>/template/plugins/autoNumeric/autoNumeric.js"></script>
<script>
    var table
    $(document).ready(function() {
        $('#datepicker').datepicker({
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });
        $('.autonumber').autoNumeric('init');
    })
</script>
<?= $this->endSection() ?>