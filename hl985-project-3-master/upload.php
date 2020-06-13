<?php
  // DO NOT REMOVE!
  include("includes/init.php");
  // DO NOT REMOVE!
  $title = "Upload";
  include("includes/function.php");

  $messages = array();

  const MAX_FILE_SIZE = 1000000;

  if( isset($_POST["submit_upload"]) && is_user_logged_in() ){
    $valid_file_upload = TRUE;
    //filter input for dog_pic and dog_desc parameters

    if($_FILES['dog_pic']['error'] == UPLOAD_ERR_OK){
      $upload_info = $_FILES['dog_pic'];

      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

      $source = filter_input(INPUT_POST, 'source', FILTER_SANITIZE_URL);

      $file_name = basename($upload_info['name']);
      $file_ext = strtolower( pathinfo($file_name, PATHINFO_EXTENSION) );


      $sql = "INSERT INTO images (description, ext, source, user_id) VALUES (:description, :file_ext, :source, :user_id);";
      $params = array(
        ':user_id' => $current_user['id'],
        ':file_ext' => $file_ext,
        ':description' => $description,
        ':source' => $source
      );
      $results = exec_sql_query($db, $sql, $params);

      $id = $db->lastInsertId("id");
      $new_path = "uploads/images/" . $id ."." . $params[':file_ext'];

      move_uploaded_file( $_FILES['dog_pic']['tmp_name'], $new_path);

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
    }else{
      $valid_file_upload = FALSE;
      $upload_info = NULL;
      throw new UploadException($_FILES['dog_pic']['error']);
    }
  }

  // deleting a picture
  if(isset($_GET['delete'])){
    $delete = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_BOOLEAN);
    $id = filter_input(INPUT_GET, 'pic-id', FILTER_VALIDATE_INT);

    $sql = "SELECT ext FROM images WHERE id = :id;";
    $params = array(
      ':id' => $id
    );
    $result = exec_sql_query($db, $sql, $params);
    if($result){
      $exts = $result->fetchAll();
      if(count($exts) > 0) {
        $ext = $exts[0];
      }
    }
    $path = "uploads/images/" . $id . "." . $ext['ext'];
    unlink($path);

    $sql2 = "DELETE FROM images WHERE id = :id;";

    exec_sql_query($db, $sql2, $params);

    $sql3 = "DELETE FROM image_tags WHERE image_id = :id;";
    exec_sql_query($db, $sql3, $params);

  }

  // deleting a tag
  if(isset($_GET['remove']) && isset($_GET['tag_id']) && isset($_GET['img_id']) ){
    $remove = filter_input(INPUT_GET, 'remove', FILTER_VALIDATE_BOOLEAN);
    $tag_id = filter_input(INPUT_GET, 'tag_id', FILTER_VALIDATE_INT);
    $img_id = filter_input(INPUT_GET, 'img_id', FILTER_VALIDATE_INT);

    $sql = "DELETE FROM image_tags WHERE image_id = :img_id AND tag_id = :tag_id";
    $params = array(
      ':img_id' => $img_id,
      ':tag_id' => $tag_id
    );

    exec_sql_query($db, $sql, $params);
  }

?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php"); ?>

<body>
    <?php

    include("includes/header.php");
    // Upload & Login Code
    // Code Source: INFO 2300 Lab 8
    if(is_user_logged_in() ){
      foreach ($messages as $message){
        echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
      }

    ?>
    <h2>Upload a Dog Picture</h2>

    <form id="uploadFile" action="upload.php" method="post" enctype="multipart/form-data">
      <ul>
        <li>
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />

          <label for="dog_pic" class="next">Upload Picture:</label>
          <input id="dog_pic" type="file" name="dog_pic">
        </li>
        <li>
          <label for="source" class="next">Source of Picture:</label>
          <input id="source" name="source" type="url">
        </li>
        <li>
          <label for="dog_desc">Description:</label>
          <textarea id="dog_desc" name="description" cols="40" rows="5"></textarea>
        </li>
        <li>
          <label for="tags">Tags: (Hold down the Ctrl (windows) / Command (Mac) button to select multiple tags.)</label>
          <select id="tags" name="tags[]" size="10" multiple>
            <?php
              $sql = "SELECT * FROM tags";
              $params = array();
              $tags = exec_sql_query($db, $sql, $params)->fetchAll();
              foreach($tags as $tag){
                echo "<option value='" . htmlspecialchars($tag['id']) ."'>" . htmlspecialchars($tag['tag']) . "</option>";
              }
            ?>
          </select>
        </li>
        <li>
          <label for="newTags">Can't find the tag(s) you want? <br/>Add new tags: (Separate the tags by pressing Enter)</label>
          <textarea id='newTags' name="newTags" rows="5" cols="25"></textarea>
        </li>
        <li>
          <button name="submit_upload" type="submit">Upload Picture</button>
        </li>
      </ul>
    </form>

      <h2>Your Dog Pictures</h2>

      <?php
      $images = exec_sql_query($db, "SELECT * FROM images WHERE user_id = :user_id;", array(':user_id' => $current_user['id']))->fetchAll();

      if(count($images) > 0){
        $button = TRUE;
        print_image_table($images, $button);
      }else{
        echo '<p><strong>No dog pictures uploaded yet. Try uploading a picture!</strong></p>';
      }
      ?>

    <?php
    }else{
      ?>
      <p><strong>You need to sign in before you can upload dog pictures in the dog gallery!</strong></p>
      <?php
      include("includes/login.php");
    }
    ?>
</body>

</html>
