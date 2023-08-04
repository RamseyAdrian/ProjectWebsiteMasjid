<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--------------------Font Used-------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <!--------------------CSS-------------------------------------------->
    <link rel="stylesheet" href="css/style-login.css">
    <!--------------------SweetAlert-------------------------------------------->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
</head>

<body id="bg-login">
    <div class="logo">
        <img src="img/logo.jpg" alt="">
    </div>
    <div class="login-container">
        <h2>Form Login</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div class="text-input" style="margin-top: 0.8em ;">
                    <input type="checkbox" value="isRememberMe">Remember Me
                </div>
            </div>
            <button type="submit" name="login" value="login">Login</button>
        </form>

        <?php
        if (isset($_POST['login'])) {
            session_start();
            include 'db.php';

            $user = mysqli_real_escape_string($conn, $_POST['username']);
            $pass = mysqli_real_escape_string($conn, $_POST['password']);

            $cek_admin = mysqli_query($conn, "SELECT * FROM admin WHERE username = '" . $user . "' AND password = '" . $pass . "' ");
            $cek_master = mysqli_query($conn, "SELECT * FROM masteradmin WHERE username = '" . $user . "' AND password = '" . $pass . "' ");

            if (mysqli_num_rows($cek_admin) > 0) {
                $fetch_admin = mysqli_fetch_object($cek_admin);
                $_SESSION['status_login'] = true;
                $_SESSION['role_login'] = 'admin';
                $_SESSION['fetch_data'] = $fetch_admin;
                $_SESSION['id'] = $fetch_admin->id;
                $_SESSION['name'] = $fetch_admin->name;
                echo '<script>window.location="dashboard.php"</script>';
                unset($_SESSION[$pass]);
            } else if (mysqli_num_rows($cek_master) > 0) {
                $fetch_master = mysqli_fetch_object($cek_master);
                $_SESSION['status_login'] = true;
                $_SESSION['role_login'] = 'masteradmin';
                $_SESSION['fetch_data'] = $fetch_master;
                $_SESSION['id'] = $fetch_master->id;
                $_SESSION['name'] = $fetch_master->name;
                echo '<script>window.location="dashboard.php"</script>';
                unset($_SESSION[$pass]);
            } else {
                echo '<script>swal("Username atau Password Salah !");</script>';
            }
        }
        ?>
    </div>
</body>

</html>