<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Tambah Gaji</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= base_url() ?>/admin/gaji">Gaji</a>
                </li>
                <li>
                    Input Gaji
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
            <form class="form-horizontal" action="<?= site_url('admin/gaji/store-gaji') ?>" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Karyawan</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="karyawan_id" required>
                            <option value="">-- Pilih Karyawan --</option>
                            <?php
                            foreach ($karyawan as $k) :
                                $nip = [
                                    0 => substr($k['nip'], 0, 8),
                                    1 => substr($k['nip'], 8, 6),
                                    2 => substr($k['nip'], 14, 1),
                                    3 => substr($k['nip'], 15, 3),
                                ];
                                $nip = $nip[0] . " " . $nip[1] . " " . $nip[2] . " " . $nip[3]; ?>
                                <option value="<?= $k['id'] ?>"><?= $nip ?> - <?= $k['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Gaji Pokok</label>
                    <div class="col-md-10">
                        <div class="input-group m-t-10" bis_skin_checked="1">
                            <span class="input-group-addon">Rp</span>
                            <select class="form-control" name="gaji_pokok">
                                <option value="1000000">1.000.000</option>
                                <option value="2000000">2.000.000</option>
                                <option value="3000000">3.000.000</option>
                                <!-- Tambahkan value-value lain sesuai kebutuhan -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Uang Makan</label>
                    <div class="col-md-10">
                        <div class="input-group m-t-10" bis_skin_checked="1">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" placeholder="" class="form-control autonumber" name="uang_makan" value="50000">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Uang Tambahan</label>
                    <div class="col-md-10">
                        <div class="input-group m-t-10" bis_skin_checked="1">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" placeholder="" class="form-control autonumber" name="uang_tambahan">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Potongan Gaji</label>
                    <div class="col-md-10">
                        <div class="input-group m-t-10" bis_skin_checked="1">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" placeholder="" class="form-control autonumber" name="potongan">
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
                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="tanggal_gajian" value="<?= $date ?>">
                            <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-md-2 control-label">Jumlah Absen</label>
                    <div class="col-md-10">
                        <input type="text" placeholder="" class="form-control autonumber" name="absen">
                    </div>
                </div> -->
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