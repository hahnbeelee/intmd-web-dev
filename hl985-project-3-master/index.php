<?php
// DO NOT REMOVE!
include("includes/init.php");
include("includes/function.php");
// DO NOT REMOVE!
$title = "Home";
?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php"); ?>

<body>
  <?php
    include("includes/header.php");

    function printStripElement($image){
      ?>
      <div class="site">
        <?php
          echo "<!-- Source: " . $image['source'] ."-->";
          print_img($image);
          echo "<cite><a href='" . $image['source'];
        ?>
        '>Source</a></cite>
      </div>
      <?php
    }
  ?>
  <div class="strip">
  <?php
    $sql = "SELECT * FROM images";
    $params = array();
    $images = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    for($id = 0; $id < 6; $id++){
      printStripElement($images[$id]);
    }
  ?>
  </div>

  <h1 class="centered">Welcome! </h1>
  <h2 class="centered">Hi, welcome to the Dog Gallery! Here you can find a collection of pictures of dogs! It is a welcoming community where all dog lovers can unite!</h2>
</body>
</html>
