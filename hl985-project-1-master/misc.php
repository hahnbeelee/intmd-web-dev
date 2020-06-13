<?php
  include("includes/init.php");
  $title = "Misc";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Misc</title>

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
</head>

<body>
  <?php include("includes/header.php"); ?>

  <div class="main">
  <!-- Source: All pictures in array are original work by Hahnbee Lee -->
    <?php
      // Source: All pictures in array are original work by Hahnbee Lee
      for($i=1; $i <=24; $i++){
        echo "<!-- misc-$i is original work by Hahnbee Lee -->";
        echo "<img src='images/misc-$i.jpg' >";
        echo "<figcaption class=\"source\">Source: <cite>Hahnbee Lee</cite></figcaption>";
      }

      include("includes/footer.php");
    ?>
  </div>
  <?php include("includes/top-button.php");?>
</body>
</html>
