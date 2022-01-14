<?php
include_once 'include/navbar.php';
?>
<div class="container my-3">
    <h1 class="text-center">Update Category</h1>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM catagory WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {
            $_SESSION['no_category_found'] = "Category not found!";
            header('location:' . SITEURL . '/admin/managecategory.php');
        }
    } else {
        header('location:' . SITEURL . '/admin/managecategory.php');
    }
    ?>
    <div class="d-flex align-items-center justify-content-center my-3">
        <form class="col-md-5 border p-5 bg-light" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
            </div>
            <div class="mb-3">
                <label for="current_image" class="form-label">Current image:</label><br>
                <?php
                if ($current_image != "") {
                ?>
                    <img class="img-fluid img-thumbnail" src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image; ?>" alt="alt" />
                <?php
                } else {
                ?>
                    <strong>Image not added!</strong>
                <?php
                }
                ?>
            </div>
            <div class="mb-3">
                <input type="file" name="image">
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
            <input type="submit" name="submit" class="btn btn-primary" value="Update Category">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            $tmp = explode('.', $image_name);
            $ext = end($tmp);
            $image_name = "foodcategory_" . rand(000, 999) . "." . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == FALSE) {
                $_SESSION['upload'] = "Please select an image!";
                header('location:' . SITEURL . '/admin/managecategory.php');
                die();
            }
            if ($current_image != "") {
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);
                if ($remove == FALSE) {
                    $_SESSION['failed_remove'] = "Failed to remove current image";
                    header('location:' . SITEURL . '/admin/managecategory.php');
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql2 = "UPDATE catagory SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active' WHERE id = '$id'";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION['update'] = "Category updated successfully!";
        header('location:' . SITEURL . '/admin/managecategory.php');
    } else {
        $_SESSION['update'] = "Failed to update category!";
        header('location:' . SITEURL . '/admin/managecategory.php');
    }
}
?>
<?php
include 'include/footer.php';
?>