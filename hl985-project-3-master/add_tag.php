<?php
  // DO NOT REMOVE!
  include("includes/init.php");
  // DO NOT REMOVE!

  $title = "Add Tag";
  include("includes/function.php");
  // get image information


  if(isset($_GET['img_id'])){
    $id = filter_input(INPUT_GET, 'img_id', FILTER_VALIDATE_INT);
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

  //add previously existing tags
  if(isset($_POST["submit_tags"])){
    // add tags
    $tags = array_filter($_POST['tags']);

    foreach($tags as $tag){
        $sql = "INSERT INTO image_tags (image_id, tag_id) VALUES (:id, :tag_id);";
        $params = array(
        ':id' => $id,
        ':tag_id' => $tag
        );
        exec_sql_query($db, $sql, $params);
    }

    //add new tags
    $newTags = filter_input(INPUT_POST, 'newTags', FILTER_SANITIZE_STRING);
    $arrayNewTags = explode("\n", $newTags);

    $sql = "SELECT * FROM tags";
    $params = array();
    $ogTags = exec_sql_query($db, $sql, $params)->fetchAll();
    foreach($arrayNewTags as $newTag){
      if(!in_array($newTag, $ogTags)){
        $sql = "INSERT INTO tags (tag) VALUES (:newTag)";
        $params = array(
          ':newTag' => $newTag
        );
        exec_sql_query($db, $sql, $params);

        $tagId = $db->lastInsertId("id");
        $sql = "INSERT INTO image_tags (image_id, tag_id) VALUES (:id, :tagId)";
        $params = array(
          ':id' => $id,
          ':tagId' => $tagId
        );
        exec_sql_query($db, $sql, $params);
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
    $previous = basename($_GET['previous']);
    ?>
    <div id="back-button"><a href="gallery.php">To Gallery</a></div>
    <?php
    echo "<!-- Source:" . htmlspecialchars($image['source']) . "-->";
    ?>
    <img class='table-pic single-img' src="uploads/images/<?php echo htmlspecialchars($image['id']) . "." . htmlspecialchars($image['ext']); ?>" alt="<?php echo htmlspecialchars($image['description']); ?>">
    <?php
    echo "<div class='centered'><cite><a  href='" . htmlspecialchars($image['source']) . "'>Source</a></cite></div>";
    echo "<p class='centered'>" . htmlspecialchars($image['description']) . "</p>";
    $button = FALSE;
    ?>
    <div class='centered'>
    <?php print_tags($image['id'], $button);
  ?>
  </div>
  <h2>Add Tags to This Picture</h2>
  <form id='tagForm' action='add_tag.php?<?php echo http_build_query( array('img_id' => $id) );?>' method='post'>
    <ul>
        <li>
          <label for="tags">Tags: (Hold down the Ctrl (windows) / Command (Mac) button to select multiple tags.)</label>
          <select id="tags" name="tags[]" size="10" multiple>
            <?php
              $sql = "SELECT * FROM tags";
              $params = array();
              $tags = exec_sql_query($db, $sql, $params)->fetchAll();
              foreach($tags as $tag){
                echo "<option value='" . $tag['id'] ."'>" . $tag['tag'] . "</option>";
              }
            ?>
          </select>
        </li>
        <li>
          <p>Can't find the tag(s) you want? <br/>Add new tags: (Separate the tags by pressing Enter)</p>
          <textarea id="newTags" name="newTags" rows="5" cols="25"></textarea>
        </li>
        <li>
          <button name="submit_tags" type="submit">Add Tag(s)</button>
        </li>
    </ul>
  </form>
</body>

</html>
