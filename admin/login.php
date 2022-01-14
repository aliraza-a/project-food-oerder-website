<?php
include '../config/constants.php';
?>
<!doctype html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center">Login</h1>
        <div class="row col-md-12 my-3 text-center">
            <strong>
                <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if (isset($_SESSION['no_login_message'])) {
                    echo $_SESSION['no_login_message'];
                    unset($_SESSION['no_login_message']);
                }
                ?>
            </strong>
        </div>
        <div class="d-flex align-items-center justify-content-center my-5">
            <form class="col-md-5 border p-5 bg-light" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="********">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <div class="d-grid">
                    <input type="submit" name="submit" class="btn btn-primary" value="Login">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "Login successful!";
        $_SESSION['user'] = $username;
        header("location:" . SITEURL . '/admin/index.php');
    } else {
        $_SESSION['login'] = "Incorrect username or password!";
        header("location:" . SITEURL . '/admin/login.php');
    }
}
?>