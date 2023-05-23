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
    </style>
</head>

<body>
    <div style="text-align:center">
        <h3>SLIP GAJI</h3>
        <p>SD NEGERI SIDOREJO</p>
    </div>
    <hr/>
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
                <td>GAJI</td>
                <td></td>
                <td></td>
                <td>Uang Makan</td>
                <td>Potongan Gaji</td>
                <td>Jumlah</td>
                <td>tangal</td>
            </tr>
        </tbody>
    </table>
</body>

</html>