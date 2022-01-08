<!-- ini login untuk masyarakat -->
<?php
session_start();
if (isset($_SESSION['nik'])) {
    if ($_SESSION['level'] == 'masyarakat') {
        header('Location:masyarakat/menulis_pengaduan.php');
    } else if (($_SESSION['level'] == 'admin') or ($_SESSION['level'] == 'petugas')) {
        header('Location:administrator/verivikasi/verivikasi_non_valid.php');
    } else {
        echo '<script>
        alert("location:/logout.php");
        </script>';
    }
}
require 'lib/koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];


    $result = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username='$username' AND password='$pass'");
    $data = mysqli_num_rows($result);
    $ada = mysqli_fetch_array($result);

    // jka data tidak ada
    if ($data == 0) {
        echo '
        <script>
        alert("maaf  username  ' . $username . ' belum terdaftar");
        document.location="index.php";
        </script>
        ';
        exit;
    } else {
        $_SESSION['nama'] = $ada['nama'];
        $_SESSION['nik'] = $ada['nik'];
        $_SESSION['level'] = 'masyarakat';
        echo '
        <script>
        alert("Login Berhasil!!");
        document.location="masyarakat/menulis_pengaduan.php";
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
    <title>Halaman Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <nav class="navbar">

    </nav>

    <div class="container">
        <div class="row justify-content-center align-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <center>
                            <h4>halaman login masyarakat</h4>
                        </center>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form action="" method="POST">
                                <div class="form-group mb-3">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" autocomplete="off">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="mb-3 d-grid gap-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg-6">Login</button>
                                </div>
                            </form>
                            <a href="masyarakat/masyarakat_registrasi.php">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<link rel="stylesheet" href="assets/js/popper.min.js">
<link rel="stylesheet" href="assets/js/bootstrap.js">

</html>