<?php
include_once 'include/navbar.php';
?>
<div class="container my-5">
    <h1>Manage Orders</h1>
    <div class="row col-md-12 my-3 text-center">
        <strong>
            <?php
            if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            ?>
        </strong>
    </div>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">Serial No.</th>
                <th scope="col">Food</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Order date</th>
                <th scope="col">Status</th>
                <th scope="col">Customer name</th>
                <th scope="col">Customer contact</th>
                <th scope="col">Customer email</th>
                <th scope="col">Customer address</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        $sn = 1;
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
        ?>
                <tbody>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $food; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $total; ?></td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $customer_name; ?></td>
                    <td><?php echo $customer_contact; ?></td>
                    <td><?php echo $customer_email; ?></td>
                    <td><?php echo $customer_address; ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>/admin/updateorder.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm">Update</a>
                        <a href="<?php echo SITEURL; ?>/admin/deleteorder.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tbody>
            <?php
            }
        } else {
            ?>
            <div class="row col-md-12 my-3 text-center">
                <strong>
                    <?php echo 'There are no orders at the moment!'; ?>
                </strong>
            </div>
        <?php
        }
        ?>
    </table>
</div>
<?php
include 'include/footer.php';
?>