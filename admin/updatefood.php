<?php
include_once 'include/navbar.php';
?>
<div class="container my-3">
    <h1 class="text-center">Update Food</h1>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql2 = "SELECT * FROM food WHERE id = $id";
        $res2 = mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($res2);
        if ($count == 1) {
            $row2 = mysqli_fetch_assoc($res2);
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['catagory_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        } else {
            $_SESSION['no_category_found'] = "Food not found!";
            header('location:' . SITEURL . '/admin/managefood.php');
        }
    } else {
        header('location:' . SITEURL . '/admin/managefood.php');
    }
    ?>
    <div class="d-flex align-items-center justify-content-center my-3">
        <form class="col-md-5 border p-5 bg-light" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <div class="form-floating">
                    <textarea name="description" value="<?php echo $description; ?>" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="<?php echo $price; ?>">
            </div>
            <div class="mb-3">
                <label for="current_image" class="form-label">Current image:</label><br>
                <?php
                if ($current_image != "") {
                ?>
                    <img class="img-fluid img-thumbnail" src="<?php echo SITEURL; ?>/images/food/<?php echo $current_image; ?>" alt="alt" />
                <?php
                } else {
                ?>
                    <strong>Image not added!</strong>
                <?php
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label><br>
                <input type="file" name="image">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <div class="dropdown">
                    <select name="category" class="btn btn-secondary">
                        <?php
                        $sql = "SELECT * FROM catagory WHERE active = 'Yes'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $category_id = $row['id'];
                                $category_title = $row['title'];
                        ?>
                                <option <?php
                                        if ($current_category == $category_id) {
                                            echo "selected";
                                        }
                                        ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?>
                                </option>
                            <?php
                            }
                        } else {
                            ?>
                            <option value="0">No category found.</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="featured" class="form-label">Featured</label>
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input" <?php
                                                        if ($featured == "Yes") {
                                                            echo "checked";
                                                        }
                                                        ?> type="radio" name="featured" value="Yes"> Yes
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" <?php
                                                        if ($featured == "No") {
                                                            echo "checked";
                                                        }
                                                        ?> type="radio" name="featured" value="No"> No
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Active</label>
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input" <?php
                                                        if ($active == "Yes") {
                                                            echo "checked";
                                                        }
                                                        ?> type="radio" name="active" value="Yes"> Yes
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" <?php
                                                        if ($active == "No") {
                                                            echo "checked";
                                                        }
                                                        ?> type="radio" name="active" value="No"> No
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="submit" name="submit" class="btn btn-primary" value="Update Food">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            $tmp = explode('.', $image_name);
            $ext = end($tmp);
            $image_name = "food_" . rand(000, 999) . "." . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == FALSE) {
                $_SESSION['upload'] = "Please select an image!";
                header('location:' . SITEURL . '/admin/managefood.php');
                die();
            }
            if ($current_image != "") {
                $remove_path = "../images/food/" . $current_image;
                $remove = unlink($remove_path);
                if ($remove == FALSE) {
                    $_SESSION['failed_remove'] = "Failed to remove current image";
                    header('location:' . SITEURL . '/admin/managefood.php');
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql3 = "UPDATE food SET title = '$title', description = '$description', price = $price, image_name = '$image_name', catagory_id = '$category', featured = '$featured', active = '$active' WHERE id = '$id'";
    $res3 = mysqli_query($conn, $sql3);

    if ($res3 == TRUE) {
        $_SESSION['update'] = "Food updated successfully!";
        header('location:' . SITEURL . '/admin/managefood.php');
    } else {
        $_SESSION['update'] = "Failed to update food!";
        header('location:' . SITEURL . '/admin/managefood.php');
    }
}
?>
<?php
include 'include/footer.php';
?>