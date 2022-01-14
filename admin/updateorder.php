<?php
include 'include/navbar.php';
?>
<?php

?>
<div class="container my-5">
    <h1>Update Order</h1>
    <div class="row col-md-12 my-3 text-center">
        <strong>

        </strong>
    </div>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_order WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $food = $row['food'];
            $price = $row['price'];
            $qty = $row['qty'];
            $status = $row['status'];
            $customer_name = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_address = $row['customer_address'];
        } else {
            header('location:' . SITEURL . '/admin/manageorder.php');
        }
    } else {
        header('location:' . SITEURL . '/admin/manageorder.php');
    }
    ?>
    <div class="d-flex align-items-center justify-content-center my-5">
        <form class="col-md-5 border p-5 bg-light" action="" method="POST">
            <div class="mb-3">
                <label for="food_name" class="form-label">Food</label>
                <input type="text" name="food_name" class="form-control" id="food_name" value="<?php echo $food; ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" name="price" class="form-control" id="price" value="<?php echo $price; ?>">
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" name="qty" class="form-control" id="qty" value="<?php echo $qty; ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <div class="dropdown">
                    <Select name="status" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1">
                        <option <?php if ($status == "Ordered") {
                                    echo 'selected';
                                } ?> value="Ordered">Ordered</option>
                        <option <?php if ($status == "On delivery") {
                                    echo 'Selected';
                                } ?> value="On delivery">On delivery</option>
                        <option <?php if ($status == "Delivered") {
                                    echo 'Selected';
                                } ?> value="Delivered">Delivered</option>
                        <option <?php if ($status == "Cancelled") {
                                    echo 'Selected';
                                } ?> value="Cancelled">Cancelled</option>
                    </Select>
                </div>
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" id="customer_name" value="<?php echo $customer_name; ?>">
            </div>
            <div class="mb-3">
                <label for="customer_contact" class="form-label">Contact Number</label>
                <input type="text" name="customer_contact" class="form-control" id="customer_contact" value="<?php echo $customer_contact; ?>">
            </div>
            <div class="mb-3">
                <label for="customer_address" class="form-label">Address</label>
                <textarea name="customer_address" class="form-control" id="customer_address"><?php echo $customer_address; ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <input type="submit" name="submit" class="btn btn-primary" value="Update Order">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_address = $_POST['customer_address'];

    $sql2 = "UPDATE tbl_order SET qty = $qty, total = $total, status = '$status', customer_name = '$customer_name', customer_contact = '$customer_contact', customer_address = '$customer_address' WHERE id = $id";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION['success'] = "Order updated successfully!";
        header('location:' . SITEURL . '/admin/manageorder.php');
    } else {
        $_SESSION['success'] = "Failed to update order!";
        header('location:' . SITEURL . '/admin/manageorder.php');
    }
}
?>
<?php
include 'include/footer.php';
?>