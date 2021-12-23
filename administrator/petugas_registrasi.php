<?php
session_start();
require '../lib/koneksi.php';
if ($_SESSION['level'] != 'admin') {
    header('location:../logout.php');
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $no = $_POST['no'];
    $level = $_POST['level'];



    $tambah =  "INSERT INTO petugas VALUES ('','$nama','$username','$password','$no','$level')";
    $data = mysqli_query($conn, $tambah);
    if ($data) {
        echo '
        <script>
         alert("Registrasi Berhasil!");
         document.location="index.php";
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
    <nav class="row mt-3">
        <ul class="nav justify-content-end">
            <li class="nav-item justify-content-end">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Login</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center align-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <center>Registrasi<div class="text-success">Petugas</div>
                        </center>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group mb-3">
                                <label for=""> Nama</label>
                                <input type="text" name="nama_petugas" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Username</label>
                                <input type="text" name="username" autocomplete="off" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">No telp</label>
                                <input type="text" name="no" autocomplete="off" class="form-control" required>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">Level</label>
                                <select name="level" id="" class="form-control">
                                    <option value="petugas">Petugas</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3 d-grid gap-2">
                                <button type="submit" class="btn btn-success" name="submit">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/bootstrap.js"></script>

</html>