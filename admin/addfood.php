<?php
include_once 'include/navbar.php';
?>
<div class="container my-3">
    <h1 class="text-center">Add Food</h1>
    <div class="row col-md-12 my-3 text-center">
        <strong>
            <?php
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
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
                <label for="description" class="form-label">Description</label>
                <div class="form-floating">
                    <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control">
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
                                $id = $row['id'];
                                $title = $row['title'];
                        ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></>
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
            <input type="submit" name="submit" class="btn btn-primary" value="Add Food">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
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
            $image_name = "food_" . rand(000, 999) . "." . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == FALSE) {
                $_SESSION['upload'] = "Please select an image!";
                header('location:' . SITEURL . '/admin/addfood.php');
                die();
            }
        }
    } else {
        $image_name = "";
    }
    $sql2 = "INSERT INTO food SET title = '$title', description = '$description', price = $price, image_name = '$image_name', catagory_id = $category, featured = '$featured', active = '$active'";
    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == TRUE) {
        $_SESSION['add'] = "Added Successfully!";
        header('location:' . SITEURL . '/admin/managefood.php');
    } else {
        $_SESSION['add'] = "There was an error!";
        header('location:' . SITEURL . '/admin/addfood.php');
    }
}
?>
<?php
include 'include/footer.php';
?>