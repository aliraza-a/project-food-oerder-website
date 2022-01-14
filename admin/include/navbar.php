<?php
include '../config/constants.php';
include 'logincheck.php';
?>
<html>

<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-text">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Food Express</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageadmin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="managecategory.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="managefood.php">Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageorder.php">Order</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="logout.php"><input class="btn btn-danger" value="Log out"></a>
                </form>
            </div>
        </div>
    </nav>
</body>

</html>