<?php
  // DO NOT REMOVE!
  include("includes/init.php");
  // DO NOT REMOVE!

  $title = "Single Image";
  include("includes/function.php");

  if(isset($_GET['pic-id'])){
    $id = filter_input(INPUT_GET, 'pic-id', FILTER_VALIDATE_INT);

    $sql = "SELECT * FROM images WHERE id = :id;";
    $params = array(
      ':id' => $id
    );
    $result = exec_sql_query($db, $sql, $params);
    if($result) {
      $images = $result ->fetchAll();
      if(count($images) > 0) {
        $image = $images[0];
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php"); ?>

<body>
  <?php
    include("includes/header.php");
    $previous = filter_input(INPUT_GET, 'previous', FILTER_SANITIZE_SPECIAL_CHARS);
    $previous = basename($previous);
  ?>
    <div id="back-button"><a href="<?php echo htmlspecialchars($previous); ?>">Back</a></div>
  <?php
    echo "<!-- Source:" . htmlspecialchars($image['source']) . "-->";
  ?>
    <img class='table-pic single-img' src="uploads/images/<?php echo htmlspecialchars($image['id']) . "." . htmlspecialchars($image['ext']); ?>" >
    <?php
    echo "<div class='centered'><cite><a  href='" . htmlspecialchars($image['source']) . "'>Source</a></cite></div>";
    echo "<p class='centered'>" . htmlspecialchars($image['description']) . "</p>";
    ?>
    <div class="centered">
      <?php print_tags($image['id'], FALSE); ?>
    </div>
</body>

</html>
