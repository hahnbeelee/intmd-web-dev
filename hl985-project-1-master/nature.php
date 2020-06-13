<?php
  include("includes/init.php");
  $title = "Nature";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Nature</title>

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
</head>

<body>
  <?php include("includes/header.php"); ?>

  <div class="main" id="top">
    <?php
      // Source: All pictures in array are original work by Hahnbee Lee
      for($i=1; $i <=18; $i++){
        echo "<!-- nature-$i is original work by Hahnbee Lee -->";
        echo "<img src='images/nature-$i.PNG'>";
        echo "<figcaption class=\"source\">Source: <cite>Hahnbee Lee</cite></figcaption>";
      }

      for($i=19; $i <=26; $i++){
        echo "<!-- nature-$i is original work by Hahnbee Lee -->";
        echo "<img src='images/nature-$i.jpg'>";
        echo "<figcaption class=\"source\">Source: <cite>Hahnbee Lee</cite></figcaption>";
      }

      include("includes/footer.php");
    ?>
  </div>
  <?php

    include("includes/top-button.php");
  ?>

</body>
</html>
