<?php
session_start();

require '../lib/koneksi.php';

if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $no = $_POST['no'];


    $tambah =  "INSERT INTO masyarakat  VALUES ('$nik','$nama','$username','$password','$no')";
    $data = mysqli_query($conn, $tambah);
    if ($data) {
        echo '
        <script>
         alert("Registrasi Berhasil!");
         document.location="../index.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Registrasi gagal!!");
        </script>
        ';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman registrasi masyarakat</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>

<body>
    <nav class="row">
        <ul class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Login</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card ">
                    <div class="card-header">
                        <center>
                            <h4>halaman Registrasi</h4>
                        </center>
                    </div>
                    <div class="card-body mb-3">
                        <form action="" method="POST">
                            <div class="form-group mb-3">
                                <label for="">NIK</label>
                                <input type="text" name="nik" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nama</label>
                                <input type="text" name="nama" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Username</label>
                                <input type="text" name="username" required autocomplete="off" class="form-control">
                            </div>
                            <div class="from-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">No Telp</label>
                                <input type="text" name="no" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="mb-3 d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
<link rel="stylesheet" href="../assets/js/bootstrap.js">
<link rel="stylesheet" href="../assets/js/popper.min.js">

</html>