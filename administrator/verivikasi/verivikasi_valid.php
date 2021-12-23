<?php
session_start();
require '../../lib/koneksi.php';

if (($_SESSION['level'] != 'admin') and ($_SESSION['level'] != 'petugas')) {
    header('location:../../logout.php');
}

$result = mysqli_query($conn, "SELECT p.id_pengaduan as id_pengaduan ,m.nama as nama, p.tgl_pengaduan as tgl_pengaduan,p.foto as foto,p.isi_laporan as isi_laporan,p.status as status FROM pengaduan p JOIN masyarakat m WHERE p.nik=m.nik AND p.status='0'");
mysqli_fetch_assoc($result);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $update = mysqli_query($conn, "UPDATE pengaduan SET status='proses' where id_pengaduan=$id");
    if ($update) {
        header('Location:verivikasi_valid.php');
    }
    echo '
    <script>
        alert("ada proses yang salah!!");
    </script>
    ';
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <title>valid</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pengaduan masyarakat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Verivikasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="verivikasi_non_valid.php">Verivikasi Valid</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="verivikasi_valid.php">Verivikasi Valid</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="verivikas_proses.php">Verivikasi Proses</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="verivikasi_selesai.php">Verivikasi Selesai</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../laporan.php">Laporan</a>
                    </li>
                </ul>
                <div class="justify-content-end mx-2">
                    <div class="text-success"><?= $_SESSION['nama_petugas']; ?>
                        <a href="../../logout.php" class="text-warning">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </nav>
    <div class="container">
        <center>
            <h2 class="text-success">List Pengaduan Valid</h2>
        </center>
        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengadu</th>
                        <th>Tanggal Pengaduan</th>
                        <th>foto</th>
                        <th>Isi Aduan</th>
                        <th>Status</th>
                        <th>Tanggapan</th>
                        <th>Verivikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($result as $res) :
                        if ($res['status'] == 'proses') {
                            $status = "proses";
                        } else if ($res['status'] == 0) {
                            $status = 'Valid';
                        } else {
                            $status = 'Status tidak diketahui';
                        }
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $res['nama']; ?></td>
                            <td><?= $res['tgl_pengaduan']; ?></td>
                            <td><img src="../../assets/img/<?= $res['foto']; ?>" width="100px" alt=""></td>
                            <td><?= $res['isi_laporan']; ?></td>
                            <td><?= $status; ?></td>
                            <td>
                                <a href="../tanggapan.php?id=<?= $res['id_pengaduan'] ?>">
                                    <button class="btn btn-warning">Tanggapan</button>
                                </a>
                            </td>
                            <td>
                                <a href="?id=<?= $res['id_pengaduan'] ?>">
                                    <button class="btn btn-success">Telah diproses</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <table border="1">

    </table>
</body>
<script src="../../assets/js/bootstrap.js"></script>

</html>