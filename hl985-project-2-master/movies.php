<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!

$title = "Movies";
include("includes/function.php");

$db = open_sqlite_db("secure/data.sqlite");

?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php"); ?>

<body>
    <?php include("includes/header.php");

    $sql = "SELECT * FROM movies;";
    $params = array();
    $result = exec_sql_query($db, $sql, $params);

    $records = $result->fetchAll();
    ?>
    <h2>Hahnbee's Favorite Movies</h2>
    <table>
      <tr>
        <th>Title</th>
        <th>Release Date</th>
        <th>Rating</th>
        <th>Genre</th>
        <th>Description</th>
        <th>Opinion</th>
      </tr>


      <?php
        $i = 1;
          foreach($records as $record){
              print_record($record);
              $i++;
              if($i == 8){ break;}
          }
      ?>
    </table>
    <h2>Other People's Opinions</h2>
    <table>
      <tr>
          <th>Title</th>
          <th>Opinion</th>
      </tr>

      <?php

        foreach($records as $record){
          if($record['id'] > 7){
            print_opinion($record);
          }
        }
      ?>
    </table>

</body>
</html>
