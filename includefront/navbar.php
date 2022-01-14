<?php
include 'config/constants.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>FoodExpress</title>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="images/logo3.svg" alt="FoodExpress logo" class="img-responsive" style="width: 200px;">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>/categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>/foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>/order.php">Order</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>