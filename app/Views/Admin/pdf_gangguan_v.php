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
    <div style="font-size:64px; color:'#dddddd'"><i>Ticket Gangguan</i></div>
    <div style="font-size:40px; color:'#dddddd'"><i>Gangguan Internet ICONNET</i></div>
    <p>
        <i>Tanggal Masuk Gangguan :<?= $tanggal_ditangani ?></i><br>
        <i>ID Gangguan : <?= $no_laporan ?></i><br>
    </p>
 
    <hr>
    <hr>
    <p></p>
    <p>

    </p>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Pelapor</th>
                <th>Alamat</th>
                <th>Nomor Handphone Pelapor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $pelapor ?></td>
                <td><?= $alamat  ?></td>
                <td><?= $no_telp ?></td> 
            </tr>

        </tbody>
    </table>
    <br>
    <br>
    <i>Akan Ditangani Oleh :</i><br>
    <?php foreach ($teknisi as $value =>$val) {
        echo "<b>$val[teknisi] - </b><i>$val[kd_teknisi] </i><br>";
        } ?>
    
</body>

</html>