<?php
include_once 'include/navbar.php';
?>
<div class="container my-5">
    <h1>Dashboard</h1>
    <div class="d-flex ">
        <div class="card my-3 mx-auto" style="width: 18rem;">
            <div class="card-body text-center">
                <h6 class="card-title">Catagories</h6>
                <?php
                $sql = "SELECT * FROM catagory";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                ?>
                <h1 class="card-title my-3">
                    <?php echo $count; ?>
                </h1>
                <p class="card-text">Available catagories.</p>
            </div>
        </div>
        <div class="card my-3 mx-auto" style="width: 18rem;">
            <div class="card-body text-center">
                <h6 class="card-title">Food</h6>
                <?php
                $sql2 = "SELECT * FROM food";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                ?>
                <h1 class="card-title my-3">
                    <?php echo $count2; ?>
                </h1>
                <p class="card-text">Available foods.</p>
            </div>
        </div>
        <div class="card my-3 mx-auto" style="width: 18rem;">
            <div class="card-body text-center">
                <h6 class="card-title">Total Orders</h6>
                <?php
                $sql3 = "SELECT * FROM tbl_order";
                $res3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($res3);
                ?>
                <h1 class="card-title my-3">
                    <?php echo $count3; ?>
                </h1>
                <p class="card-text">Total number of orders.</p>
            </div>
        </div>
        <div class="card my-3 mx-auto" style="width: 18rem;">
            <div class="card-body text-center">
                <h6 class="card-title">Total Revenue</h6>
                <?php
                $sql4 = "SELECT SUM(total) AS total FROM tbl_order WHERE status = 'delivered'";
                $res4 = mysqli_query($conn, $sql4);
                $row = mysqli_fetch_assoc($res4);
                $total_revenue = $row['total'];
                ?>
                <h1 class="card-title my-3">
                    $<?php echo $total_revenue; ?>
                </h1>
                <p class="card-text">Total revenue generated.</p>
            </div>
        </div>
    </div>
</div>
<?php
include 'include/footer.php';
?>