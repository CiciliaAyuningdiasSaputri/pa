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
<div class="card-box table-responsive">
    <div class="row m-b-10">
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

    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Gajian</th>
                <th>Nama Karyawan</th>
                <th>Gaji</th>
                <th>Uang Makan</th>
                <th>Uang Tambahan</th>
                <th>Potongan</th>
            </tr>
        </thead>
    </table>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    var table;

    $(document).ready(function() {
        table = $('#datatable').DataTable({
            "aLengthMenu": [
                [10, 30, 50, 100],
                [10, 30, 50, 100]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= site_url('/admin/laporan/get-laporan-json') ?>',
                type: 'POST',
                data: function(data) {
                    data.bulan = $('#filter-bulan').val();
                    data.tahun = $('#filter-tahun').val();
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'tanggal_gajian',
                    name: 'tanggal_gajian'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'gaji_pokok',
                    name: 'gaji_pokok'
                },
                {
                    data: 'uang_makan',
                    name: 'uang_makan'
                },
                {
                    data: 'uang_tambahan',
                    name: 'uang_tambahan'
                },
                {
                    data: 'potongan',
                    name: 'potongan'
                },
            ],
        });

        // Fungsi untuk menangani perubahan pada filter bulan dan tahun
        $('#filter-bulan, #filter-tahun').on('change', function() {
            table.ajax.reload(); // Muat ulang data tabel saat filter berubah
        });

        table.on('draw.dt', function() {
            var Page = $('#datatable').DataTable().page.info();
            table.column(0, {
                page: 'current'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + Page.start;
            });
        });
    });
</script>
<?= $this->endSection() ?>