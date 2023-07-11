<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
            height: 20px;
            margin: 8px;
        }
    </style>
</head>

<body>
    <div style="font-size:64px; color:'#dddddd'"><i>Invoice</i></div>
    <p>
        <i>Dea Venditama Shops</i><br>
        Jakarta, Indonesia
    </p>
    <hr>
    <hr>
    <p></p>
    <p>

    </p>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kecepatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pelanggan as $p) : ?>
                <tr>
                    <td><?= $p['id_pelanggan']; ?></td>
                    <td><?= $p['nama_pelanggan']; ?></td>
                    <td><?= $p['alamat']; ?></td>
                    <td><?= $p['kecepatan']; ?> mbps</td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>