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
    <div style="font-size:64px; color:'#dddddd'"><i>List Pekerjaan </i></div>
    <div style="font-size:18px; color:'#dddddd'"><i>Nama :<?php echo $nama ?> </i></div>
    <div style="font-size:18px; color:'#dddddd'"><i>Nomor Pegawai :<?php echo $kd_teknisi ?> </i></div>
    <!-- <div style="font-size:40px; color:'#dddddd'"><i>Gangguan Internet ICONNET</i></div> -->
    <p>
        <i>Tanggal :<?= date('Y-m-d'); ?></i><br>
    </p>
 
    <hr>
    <hr>
    <p></p>
    <p>

    </p>
    <table class="table borderless" id="dataTable" width="100%" cellspacing="0" style ="border:none;" border ="0">
        <thead>
            <tr>
                <th>Nomor penanganan</th>
                <th>Sebagai</th>
                <th>Tanggal Penanganan</th>
                <th>Jenis Penanganan</th>
                <th>Keterangan</th>
                <th>Nama Pelapor</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $value =>$val) { ?>
            <tr>
                <td><?= $val->NO_PENANGANAN ?></td>
                <td><?= $val->PERAN  ?></td>
                <td><?= $val->TGL_PENANGANAN ?></td>
                <td><?= $val->JENIS_PENANGANAN  ?></td>
                <td><?= $val->KETERANGAN  ?></td>
                <td><?= $val->NAMA  ?></td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
    <br>
    <br>
    
</body>

</html>