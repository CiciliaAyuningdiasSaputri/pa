<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Data Gaji</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= base_url() ?>/karyawan/gaji">Gaji</a>
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Filter</b></h4>
            <form class="form-inline" id="formGajiFilter">
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
                    <select class="form-control" name="tahun" id="filter-tahun" required>
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
                <button type="button" id="btn-filter" class="btn btn-custom waves-effect waves-light btn-md">
                    Tampilkan
                </button>
                <button type="button" id="btn-reset" class="btn btn-success waves-effect waves-light btn-md">
                    Reset
                </button>
                <!-- <div class="d-flex flex-row-reverse bd-highlight">
                    <a href="<?php echo base_url('PdfController/htmlToPDF') ?>" class="btn btn-primary">
                    Download PDF
                    </a> -->
    </div>
            </form>
        </div>
    </div>
</div>
<div class="card-box table-responsive" id="gajiView">
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Gaji</th>
                <th>Nama</th>
                <th>Gaji Pokok</th>
                <th>Uang Makan</th>
                <th>Potongan Gaji</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var table
    $(document).ready(function() {
        table = $('#datatable').DataTable({
            "aLengthMenu": [
                [10, 30, 50, 100],
                [10, 30, 50, 100]
            ],
            // "iDisplayLength": 10,
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= site_url('/karyawan/gaji/get-gaji-json') ?>',
                type: 'POST',
                "data": function(data) {
                    if ($('#btn-filter').data('clicked')) {
                        data.bulan = $('#filter-bulan').val();
                        data.tahun = $('#filter-tahun').val();
                    }
                }
            },
            "columnDefs": [ //Set column definition initialisation properties.
                {
                    "targets": [0, 4], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            columns: [{
                    data: "no",
                    name: "no",
                    orderable: false,
                },
                {
                    data: "tanggal",
                    name: "tanggal",
                },
                {
                    data: "nama",
                    name: "nama",
                },
                {
                    data: "gaji_pokok",
                    name: "gaji_pokok",
                },
                {
                    data: "uang_makan",
                    name: "uang_makan",
                },
                {
                    data: "potongan",
                    name: "potongan",
                },
                {
                    data: "jumlah",
                    name: "jumlah",
                },
                {
                    data: "action",
                    name: "action",
                },
            ],
        });
        table.on('draw.dt', function() {
            var Page = $('#datatable').DataTable().page.info();
            table.column(0, {
                page: 'current'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + Page.start;
            });
        });

        $('#btn-filter').click(function() { //button filter event click
            $(this).data('clicked', true);
            table.ajax.reload(); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#formGajiFilter')[0].reset();
            table.ajax.reload(); //just reload table
        });

    })
</script>
<?= $this->endSection() ?>