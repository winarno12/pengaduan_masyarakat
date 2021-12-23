<!-- ini login untuk administrator/petugas -->
<?php
session_start();
require '../lib/koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];


    $result = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username' AND password='$pass'");
    $data = mysqli_num_rows($result);
    $ada = mysqli_fetch_assoc($result);
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
        $_SESSION['id'] = $ada['id_petugas'];
        $_SESSION['nama_petugas'] = $ada['nama_petugas'];
        $_SESSION['level'] = $ada['level'];
        echo '
        <script>
        alert("Login Berhasil!!");
        document.location="verivikasi/verivikasi_non_valid.php";
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
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center align-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <center>
                            <h4>halaman login Administrator</h4>
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
                                    <button type="submit" name="submit" class="btn btn-success btn-lg-6">Login Admin</button>
                                </div>
                            </form>
                            <a href="petugas_registrasi.php">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<link rel="stylesheet" href="../assets/js/popper.min.js">
<link rel="stylesheet" href="../assets/js/bootstrap.js">

</html>