<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print </title>
</head>

<body>
    <h1>Data Nomor Surat</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Sifat</th>
            <th>Nomor Surat</th>
            <th>Tujuan Surat</th>
            <th>Perihal</th>
            <th>Tanggal Surat</th>
            <th>Jenis Surat</th>
            <th>Pejabat Penandatangan</th>
            <th>Petugas Input</th>
            <th>Waktu Pengajuan</th>
        </tr>

        <?php $no = 1;
        foreach ($print as $p) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p->sifat ?></td>
                <td><?= $p->nomor ?></td>
                <td><?= $p->tujuan_surat ?></td>
                <td><?= $p->perihal ?></td>
                <td><?= $p->tanggal_surat ?></td>
                <td><?= $p->jenis_arsip ?></td>
                <td><?= $p->jabatan ?></td>
                <td><?= $p->nama ?></td>
                <td><?= $p->created_at ?></td>
            </tr>

        <?php endforeach ?>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>