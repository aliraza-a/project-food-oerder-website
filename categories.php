<?php
include 'includefront/navbar.php';
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Explore Foods</h2>
    <?php
    $sql = "SELECT * FROM catagory WHERE active = 'Yes'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
    ?>
        <a href="<?php echo SITEURL; ?>/category-foods.php?category_id=<?php echo $id; ?>">
          <div class="box-3 float-container">
            <?php
            if ($image_name != "") {
            ?>
              <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name ?>" alt="" class="img-responsive img-curve" />
            <?php
            } else {
              echo 'Image not available';
            }
            ?>

            <h3 class="float-text text-white"><?php echo $title; ?></h3>
          </div>
        </a>
      <?php
      }
    } else {
      ?>
      <strong><?php echo 'No catagories available!'; ?></strong>
    <?php
    }
    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- Categories Section Ends Here -->
<?php
include 'includefront/footer.php';
?>