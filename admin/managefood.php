<?php
include_once 'include/navbar.php';
?>
<div class="container my-5">
    <h1>Manage Foods</h1>
    <div class="row col-md-12 my-3 text-center">
        <strong>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['no_category_found'])) {
                echo $_SESSION['no_category_found'];
                unset($_SESSION['no_category_found']);
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if (isset($_SESSION['failed_remove'])) {
                echo $_SESSION['failed_remove'];
                unset($_SESSION['failed_remove']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
        </strong>
    </div>
    <div class="row col-md-2 my-3">
        <a href="addfood.php" class="btn btn-primary">Add Food</a>
    </div>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">Serial No.</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Featured</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <?php
            $sql = "SELECT * FROM food";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $price = $rows['price'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
            ?>
                        <tr>
                            <th scope="row"><?php echo $sn++; ?></th>
                            <td><?php echo $title; ?></td>
                            <td>$<?php echo $price; ?></td>
                            <td>
                                <?php
                                if ($image_name != "") {
                                ?>
                                    <img class="img-fluid img-thumbnail" style="width: 150px" src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="alt" />
                                <?php
                                } else {
                                    echo 'image not added!';
                                }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>/admin/updatefood.php?id=<?php echo $id; ?> & image_name=<?php echo $image_name; ?>" class="btn btn-success btn-sm">Update</a>
                                <a href="<?php echo SITEURL; ?>/admin/deletefood.php?id=<?php echo $id; ?> & image_name=<?php echo $image_name; ?>" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include 'include/footer.php';
?>