<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        body {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        }

        #table {
            width: 100%;
        }

        #table td,
        #table th {
            padding: 8px;
        }

        #table tr:nth-child(even) {
            /* background-color: #f2f2f2; */
        }

        #table tr:hover {
            /* background-color: #ddd; */
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            /* background-color: #4CAF50; */
            color: white;
        }

        .container {
            margin-top: 100px;
            position: relative;
            min-height: 100vh;
            /* Set tinggi minimal 100% dari viewport */
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .left-signature,
        .right-signature {
            width: 45%;
            /* Atur lebar sesuai kebutuhan */
            margin-top: auto;
        }

        .left-signature {
            float: left;
            /* Mengatur posisi tanda tangan kiri di sebelah kiri */
        }

        .right-signature {
            float: right;
            text-align: right;
            /* Mengatur posisi tanda tangan kanan di sebelah kanan */
        }
    </style>
</head>


<body>
    <div style="text-align:center">
<<<<<<< HEAD
        <h3><?= $title_pdf; ?></h3>
=======
        <p> PEMERINTAH KABUPATEN LAMONGAN</p>
        <p>DINAS PENIDIDKAN</p>
        <p>SEKOLAH DASAR NEGERI SIDOREJO</p>
        <p>JL. Kadet Soewoko No. 107 A Sidorejo</p>
        <p>Kecamatan Deket       Kode Pos : 62291</p>
        <h3>SLIP GAJI</h3>
>>>>>>> d3080f18d1ffe1a8845599fac6b85c2b40e01c31
        <p>SD NEGERI SIDOREJO</p>
    </div>
    <hr />
    <table id="table">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"></td>
                <td>Tanggal</td>
                <td>Gaji Pokok</td>
                <td>Uang Makan</td>
                <td>Uang Tambahan</td>
                <td>Potongan Gaji</td>
                <td>Jumlah</td>
            </tr>
            <?php foreach ($gaji as $g) : ?>
                <tr>
                    <td scope="row"></td>
                    <td><?= $g['tanggal_gajian'] ?></td>
                    <td><?= $g['gaji_pokok'] ?></td>
                    <td><?= $g['uang_makan'] ?></td>
                    <td><?= $g['uang_tambahan'] ?></td>
                    <td><?= $g['potongan'] ?></td>
                    <td><?= $jumlah ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- ttd -->
    <div class="container">
        <div class="left-signature">
            <p>Mengetahui,</p>
            <p>Kepala Sekolah</p>
            <br>
            <br>
            <br>
            <p>_______________________</p>

        </div>
        <div class="right-signature">
            <p>Surabaya, <?= date('d F Y') ?></p>
            <p>Sekretaris</p>
            <br>
            <br>
            <br>
            <p>_______________________</p>
        </div>
    </div>

</body>

</html>