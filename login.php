<?php

session_start();
include 'functions.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'")) > 0) {
        $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        $detail = query("SELECT * FROM user WHERE email = '$email'")[0];
        $id_user = $detail['id_user'];
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["id_user"] = $id_user;
                $_SESSION["login"] = true;
                $_SESSION["guru"] = true;
                $_SESSION["email"] = $email;
                header("Location: guru");
                exit;
            }
        }
    }

    $error = true;

    if ($error) {
        echo "
            <script>
                alert('Login Gagal!');
                window.location.href='login.php';
            </script>
        ";
        exit;
    }
}

if (isset($_POST['guest'])) {
    header("Location:guest");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Saya Ingin Bertanya</title>
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="row justify-content-center w-100 mx-5">
                    <div class="col-md-10 col-lg-6 col-xxl-6">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h2 class="my-2 mb-4 text-center">"Saya Ingin Bertanya"</h2>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <button type="submit" name="login"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Masuk
                                        sebagai Guru</button>
                                </form>
                                <form action="" method="POST">
                                    <button class="btn border bg-gradient-secondary w-100" type="submit"
                                        name="guest">Masuk
                                        sebagai
                                        Tamu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>