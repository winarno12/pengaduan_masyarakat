<?php
session_start();
require '../lib/koneksi.php';
if (($_SESSION['level'] != 'admin') and ($_SESSION['level'] != 'petugas')) {
    header('Location:../logout.php');
}

// tampilkan 
if (empty($_GET['id'])) {
    header('Location:index.php');
} else {




    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $tanggapan = $_POST['tanggapan'];
        $id_petugas = $_SESSION['id'];
        $tgl = date('Y-m-d');
        $result = "INSERT INTO  tanggapan VALUES ('',$id,'$tgl','$tanggapan','$id_petugas')";
        $data = mysqli_query($conn, $result);
        if ($tanggapan) {
            header('Location:verivikasi/verivikasi_valid.php');
        } else {
            echo '<script>
        alert("tanggapan anda salah!");
        </script>';
        }
    }
    // menampilkan aduan
    $id = $_GET['id'];
    $aduan = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan=$id");
    mysqli_fetch_assoc($aduan);
    foreach ($aduan as $data) {
        if (($data['status'] != '0') and ($data['status'] != 'proses')) {
            header('Location:verivikasi/verivikasi_valid.php');
        }
    }
    // menampilkan tanggapan
    $id = $_GET['id'];
    $tanggapan = mysqli_query($conn, "SELECT  t.id_tanggapan as id_tanggapan,t.id_pengaduan as id_pengaduan,t.tgl_tanggapan as tgl_tanggapan,t.tanggapan as tanggapan,p.nama_petugas as nama_petugas  FROM tanggapan t JOIN petugas p WHERE  t.id_petugas=p.id_petugas AND id_pengaduan=$id");
    $data11 = mysqli_fetch_assoc($aduan);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman tanggapan</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>

<body>
    <!-- navbar -->
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
                            <li><a class="dropdown-item" href="verivikasi/verivikasi_non_valid.php">Verivikasi Non Valid</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="verivikasi/verivikasi_valid.php">Verivikasi Valid</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="verivikasi/verivikas_proses.php">Verivikasi Proses</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="verivikasi/verivikasi_selesai.php">Verivikasi Selesai</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../laporan.php">Laporan</a>
                    </li>
                </ul>
                <div class="justify-content-end mx-2">
                    <div class="text-success"><?= $_SESSION['nama_petugas']; ?>
                        <a href="../logout.php" class="text-warning">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar end -->
    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <center>
                            <div class="text-success">Aduan</div>
                        </center>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <?php foreach ($aduan as $adukan) : ?>
                                <thead>
                                    <tr>
                                        <th>Foto Penunjang</th>
                                        <th>Tanggal Aduan</th>
                                        <th>Isi aduan</th>
                                    </tr>
                                    <thead>
                                        <tr>
                                            <td>
                                                <img src="../assets/img/<?= $adukan['foto']; ?>" class="img img-thumbnail" alt="" width="100px">
                                            </td>
                                            <td>
                                                <?= $adukan['tgl_pengaduan']; ?>
                                            </td>
                                            <td>
                                                <?= $adukan['isi_laporan']; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </thead>
                                </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <center>Beri Tanggapan</center>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form action="" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">Beri Tanggapan</label>
                                    <textarea name="tanggapan" id="" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                                <div class="mb-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-success" name="submit">Tanggapi</button>
                                </div>
                        </div>
                        </form>
                        <!-- tanggpan -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-middle mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <center>
                            <div class="text-success">Tanggapan</div>
                        </center>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Tanggapan</th>
                                    <th>Isi Tanggapan</th>
                                    <th>Nama Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($tanggapan as $ta) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $ta['tgl_tanggapan']; ?></td>
                                        <td><?= $ta['tanggapan']; ?></td>
                                        <td><?= $ta['nama_petugas']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/bootstrap.js"></script>

</html>