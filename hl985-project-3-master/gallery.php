<?php
  // DO NOT REMOVE!
  include("includes/init.php");
  // DO NOT REMOVE!

  $title = "Gallery";
  include("includes/function.php");

  if(isset($_GET['search']) ){
    $do_search = TRUE;

    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
    $search = trim($search);
  }else{
    $do_search = FALSE;
    $search = NULL;
  }

?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php"); ?>

<body>
    <?php include("includes/header.php");
    ?>
    <h3>Search by tag</h3>

    <form id="searchForm" action="gallery.php" method="get">
      <input type="text" name="search"/>
      <button type="submit">Search</button>
    </form>

    <h4>All Tags:</h4>
    <?php
      $sqlTags = "SELECT * FROM tags";
      $paramsTags = array();
      $tags = exec_sql_query($db, $sqlTags, $paramsTags)->fetchAll(PDO::FETCH_ASSOC);
      if($tags){
        $i = 1;
        foreach($tags as $tag){
          if($i != count($tags)){
            echo htmlspecialchars($tag['tag']) . ", ";
            $i++;
          }else{
            echo htmlspecialchars($tag['tag']);
          }
        }
      }
    ?>
    <?php
      if($do_search){
        ?>
        <h2>Search Results</h2>
        <?php
        $sql = "SELECT DISTINCT images.id, images.description, images.ext, images.id, tags.tag, images.source FROM images INNER JOIN image_tags ON image_tags.image_id = images.id INNER JOIN tags ON tags.id = tag_id WHERE tags.tag LIKE '%' || :search || '%'";
        $params = array(
            'search' => $search
        );
      }else{ ?>

        <h2>All of the Dogs!</h2>
        <?php
        $sql = "SELECT * FROM images";
        $params = array();
      }
        $images = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);
        if($images){
          $button = FALSE;
          print_image_table($images, $button);
        }else{
          echo "<p>No matching tags found.</p>";
        }

        if($sql != "SELECT * FROM images"){ ?>
          <a href="gallery.php">See all dogs</a>
          <?php
        }
    ?>
</body>
</html>
