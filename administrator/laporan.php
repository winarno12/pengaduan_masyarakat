<?php
session_start();
require '../lib/koneksi.php';
if ($_SESSION['level'] != 'admin') {
    header('Location:../logout.php');
}

$result = mysqli_query($conn, "SELECT m.nama as nama,p.tgl_pengaduan as tgl_pengaduan,p.foto as foto,p.isi_laporan as isi_laporan,p.status as status FROM pengaduan p JOIN masyarakat m WHERE p.nik =m.nik");
mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>

<body>
    <center>
        <h2 class="mb-4">seluruh Laporan yang masuk</h2>
    </center>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pengadu</th>
                <th>tanggal Aduan</th>
                <th>Foto Aduan</th>
                <th>Isi aduan</th>
                <th>Status Aduan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($result as $data) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['tgl_pengaduan']; ?></td>
                    <td><img src="../assets/img/<?= $data['foto']; ?>" alt="" width="100px;"></td>
                    <td><?= $data['isi_laporan']; ?></td>
                    <td>
                        <?php if ($data['status'] == null) {
                            $status = 'Belum Valid';
                        } else if ($data['status'] == 0) {
                            $status = 'Valid';
                        } else {
                            $satus = $data['status'];
                        }
                        ?>

                        <?= $status; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script text="text/javascript">
    window.print()
</script>
<script src="../assets/js/bootstrap.js"></script>

</html>