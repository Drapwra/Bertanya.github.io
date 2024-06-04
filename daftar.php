<?php

session_start();
include 'functions.php';

if (isset($_POST['daftar'])) {

    $email = $_POST['email'];
    $id_level = 2;
    $password_sebelum = $_POST['password'];
    $password = password_hash($password_sebelum, PASSWORD_DEFAULT);

    // cek keterse
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'")) > 0) {
        echo "
            <script>
                alert('Email already exists');
                window.location.href='daftar.php';
            </script>
        ";
        exit;
    }

    mysqli_query($conn, "INSERT INTO user VALUES (
        NULL, '$id_level', '$email', '$password'
    )");

    echo "
    <script>
        alert('Registration success!');
        window.location.href='login.php';
    </script>
    ";
    exit;
}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPDB Sekolah</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/logo-sidebar.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="row justify-content-center w-100 mx-5">
                    <div class="col-md-12 col-lg-12 col-xxl-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h1 class="my-2 mb-4">Registration</h1>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Youraddress@gmail.com" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter your Password" required>
                                    </div>
                                    <button type="submit" name="daftar" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Submit</button>
                                </form>
                                <div class="d-flex justify-content-between">
                                    <a href="login.php" class="btn btn-secondary" style="background-color: grey; color: white; border: 1px solid grey">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center w-100 mx-5">
                    <img src="assets/images/logo.png" class="w-100">
                </div>
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>