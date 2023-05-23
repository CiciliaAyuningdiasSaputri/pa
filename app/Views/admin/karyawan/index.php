<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Data Karyawan</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="<?= base_url() ?>/admin/karyawan">Karyawan</a>
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="card-box table-responsive">
    <div class="row m-b-10">
        <a href="<?= site_url('admin/karyawan/add') ?>" class="btn btn-primary waves-effect waves-light m-b-5"> <i class="fa fa-plus m-r-5"></i> <span>Tambah Karyawan</span> </a>
    </div>
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>NIP</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
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
                url: '<?= site_url('/admin/karyawan/get-karyawan-json') ?>',
                type: 'POST',
            },
            "columnDefs": [ //Set column definition initialisation properties.
                {
                    "targets": [0, 5], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            columns: [{
                    data: "no",
                    name: "no",
                    orderable: false,
                },
                {
                    data: "nama",
                    name: "nama",
                },
                {
                    data: "username",
                    name: "username",
                },
                {
                    data: "nip",
                    name: "nip",
                },
                {
                    data: "jenis_kelamin",
                    name: "jenis_kelamin",
                },
                {
                    data: "jabatan",
                    name: "jabatan",
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
    })
</script>
<?= $this->endSection() ?>