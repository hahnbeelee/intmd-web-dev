<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!
$title = "Opinion";
include("includes/function.php");
$db = open_sqlite_db("secure/data.sqlite");


$messages = array();

$movies = exec_sql_query($db, "SELECT DISTINCT name FROM movies;", NULL)->fetchAll(PDO::FETCH_COLUMN);

if(isset($_POST["submit_insert"]) ){
    $valid_opinion = TRUE;
    $movie_name = filter_input(INPUT_POST, 'movie_name', FILTER_SANITIZE_STRING);
    $opinion = filter_input(INPUT_POST, 'opinion', FILTER_SANITIZE_STRING);

    //opinion required
    if($opinion == NULL){
        echo "opinion was false";
        $valid_opinion = FALSE;
    }

    if(!in_array($movie_name, $movies) ){
        echo "movie name was false";
        $valid_opinion = FALSE;
    }

    if($valid_opinion){
        $sql_insert = "INSERT INTO movies('name', 'opinion') VALUES(:movie_name, :opinion);";
        $params = array(
            ':movie_name' => $movie_name,
            'opinion' => $opinion
        );

        $result = exec_sql_query($db, $sql_insert, $params);
        if($result){
            array_push($messages, "Your review has been recorded. Thank you!");
        } else{
            array_push($messages, "Failed to add review.");
        }
    }else{
        array_push($messages, "Failed to add review. Invalid product or rating.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php"); ?>

<body>
    <?php include("includes/header.php"); ?>
    <h2>Opinion</h2>
    <p>Want to share your opinion of my favorite movies? Fill out this form!</p>

    <?php
        // Write out any messages to the user.
        foreach ($messages as $message) {
        echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
        }
        // ini_set('display_errors', 'On');
    ?>

    <form id="reviewMovie" action="opinion.php" method="post">

        <ul>
            <li>
                <label>Movie:</label>
                <select name="movie_name">
                    <option value="" selected disabled>Choose Movie</option>
                    <?php
                    foreach($movies as $movie) {
                        echo "<option value=\"" . htmlspecialchars($movie) . "\">" . htmlspecialchars($movie) . "</option>";
                      }
                    ?>
                </select>
            </li>
            <li>
                <label>Opinion:</label>
            </li>
            <li>
                <textarea name="opinion" cols="40" rows="5"></textarea>
            </li>
            <li>
            <button name="submit_insert" type="submit">Add Opinion</button>
            </li>
        </ul>
    </form>

    <?php
        $sql = "SELECT name, opinion FROM movies WHERE (id > 7);";
        $params = array();
        $result = exec_sql_query($db, $sql, $params);

        $opinions = $result->fetchAll();

        if($opinions){
    ?>
            <h2>Other People's Opinions</h2>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Opinion</th>
                </tr>
        <?php
            foreach($opinions as $opinion){
                print_opinion($opinion);
            }
        ?>
            </table>
        <?php
        }
    ?>

</body>
</html>
