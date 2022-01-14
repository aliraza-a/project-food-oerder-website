<?php
include_once 'include/navbar.php';
?>
<div class="container my-3">
    <h1 class="text-center">Add Category</h1>
    <div class="row col-md-12 my-3 text-center">
        <strong>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
        </strong>
    </div>
    <div class="d-flex align-items-center justify-content-center my-3">
        <form class="col-md-5 border p-5 bg-light" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label><br>
                <input type="file" name="image">
            </div>
            <div class="mb-3">
                <label for="featured" class="form-label">Featured</label>
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="featured" value="Yes"> Yes
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" type="radio" name="featured" value="No"> No
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Active</label>
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="active" value="Yes"> Yes
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" type="radio" name="active" value="No"> No
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }
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
                header('location:' . SITEURL . '/admin/addcategory.php');
                die();
            }
        }
    } else {
        $image_name = "";
    }

    $sql = "INSERT INTO catagory SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active'";
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        $_SESSION['add'] = "Added Successfully!";
        header('location:' . SITEURL . '/admin/managecategory.php');
    } else {
        $_SESSION['add'] = "There was an error!";
        header('location:' . SITEURL . '/admin/addcategory.php');
    }
}
?>
<?php
include 'include/footer.php';
?>