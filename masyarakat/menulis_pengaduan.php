<?php
session_start();
if ($_SESSION['level'] != 'masyarakat') {
    header('location:../logout.php');
}
require '../lib/koneksi.php';
$nik = $_SESSION['nik'];
$pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan WHERE nik='$nik'");
mysqli_fetch_assoc($pengaduan);




if (isset($_POST['submit'])) {
    $laporan = $_POST['laporan'];
    $tgl_pengaduan = date('Y-m-d');

    // $servername = 'http://localhost/php/pengaduan_masyarakat/assets/img/';

    // upload

    $locationtime = $_FILES['foto']['tmp_name'];
    $destination = '../assets/img/';
    $file_name = str_replace(' ', '', $_FILES['foto']['name']);
    $locationupload = $destination . $file_name;
    move_uploaded_file($locationtime, $locationupload);



    $data = "INSERT INTO pengaduan VALUES ('','$tgl_pengaduan','$nik','$laporan','$file_name',null )";
    $result = mysqli_query($conn, $data);

    if ($result) {
        header('Location:../masyarakat/menulis_pengaduan.php');
    } else {
        echo '<script>
       alert("data yang anda masukan salah!!");
       </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="menulis_pengaduan.php">Menulis Aduan</a>
                </li>
            </ul>
            <div class="justify-content-end">
                <?= $_SESSION['nama'] . ' <a href="../logout.php">Logout</a>' ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Laporan</label>
                                <textarea name="laporan" id="" class="form-control" cols="30" rows="5" placeholder="masukan pengaduan anda"></textarea>
                            </div>
                            <div class="mb-3 d-grid gap-2">
                                <button type="submit" class="btn btn-danger" name="submit">Adukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Ini daftar Laporan</h4>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Laporan</th>
                                <th>Nik</th>
                                <th>Foto</th>
                                <th>Isi Laporan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($pengaduan as $ada) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td> <?= $ada['tgl_pengaduan']; ?></td>
                                    <td><?= $ada['nik']; ?></td>
                                    <td><img src="../assets/img/<?= $ada['foto'] ?>" width="120px" class="rounde" alt=""></td>
                                    <td><?= $ada['isi_laporan']; ?></td>
                                    <td>
                                        <?php
                                        if ($ada['status'] == null) {
                                            echo "belum valid";
                                        } elseif ($ada['status'] == '0') {
                                            echo "Valid";
                                        } else {
                                            echo $ada['status'];
                                        }
                                        ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">


        </div>


    </div>


</body>
<script rel="stylesheet" href="../assets/js/popper.min.js"></script>
<script rel="stylesheet" href="../assets/js/bootstrap.js"></script>

</html>