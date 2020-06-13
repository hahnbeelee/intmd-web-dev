<?php
    // DO NOT REMOVE!
    include("includes/init.php");
    // DO NOT REMOVE!
    $title = "Search";
    include("includes/function.php");

    $db = open_sqlite_db("secure/data.sqlite");

    const SEARCH_FIELDS = [
        "name" => "By Title",
        "release_date" => "By Release Date",
        "rating" => "By Rating",
        "genre" => "By Genre",
        "description" => "By Description (& actors)",
        "opinion" => "By Opinion"
    ];

    if( isset($_GET['search']) && isset($_GET['category']) ){
        $do_search = TRUE;

        $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);

        //check if category exists in the SEARCH_FIELDS array
        if(in_array($category, array_keys(SEARCH_FIELDS))){
            $search_field = $category;
        }else{
            $message = "Invalid category for search.";
            $do_search = FALSE;
        }

        //get search terms
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
        $search = trim($search);

        if($category == "genre"){
            $genres = array(
                "Romance", "Horror", "Fantasy", "Animation"
            );
            if(in_array($search, $genres)){
                $search = array_search($search, $genres);
            }
        }
    }else{
        $do_search = FALSE;
        $category = NULL;
        $search = NULL;
    }
?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php"); ?>

<body>
    <?php include("includes/header.php"); ?>
    <h2>Search</h2>
    <p>
        Have a movie that you like and you want to see if I like it too? Search for it!
    </p>
    <p>
        Use key words such as title, genre, release date, actors/actresses.
    </p>

    <?php
        //messages to user
        echo "<p><strong>" . $message . "</strong></p>\n";
    ?>

    <form id="searchForm" action="search.php" method="get">
        <select name="category">
            <option value="" selected disabled>Search By</option>
            <?php
            foreach(SEARCH_FIELDS as $field_name => $label){
                ?>
                <option value="<?php echo $field_name; ?>"><?php echo $label;?></option>
                <?php
            }
            ?>
        </select>
        <input type="text" name="search"/>
        <button type="submit">Search</button>
    </form>

    <?php
    if($do_search){
        ?>
        <h2>Search Results</h2>
        <?php
        //:search = typed search field
        //$search_field - category

        $sql = "SELECT * FROM movies WHERE $search_field LIKE '%' || :search || '%'";
        $params = array(
            'search' => $search
        );
    } else{
        ?>
        <h2>All Movies</h2>
        <?php

        $sql = "SELECT * FROM movies;";
        $params = array();
    }

    //display movies
    $result = exec_sql_query($db, $sql, $params);
    if($result){
        $records = $result->fetchAll();
        ?>
        <table>
        <?php
        if( count($records) > 0 ){
            foreach($records as $record) {
                if($record['id'] < 8){
            ?>
                    <tr>
                        <th>Title</th>
                        <th>Release Date</th>
                        <th>Rating</th>
                        <th>Genre</th>
                        <th>Description</th>
                        <th>Opinion</th>
                    </tr>
            <?php
                    break;
                }
            }

            foreach($records as $record) {
                if($record['id'] < 8){
                    print_record($record);
                }
            }
            ?>
            </table>
            <?php
                foreach($records as $record){
                    if($record['id'] > 7){
            ?>
                        <h2>Other People's Opinions</h2>
                        <table>
                        <tr>
                            <th>Title</th>
                            <th>Opinion</th>
                        </tr>
            <?php
                        break;
                    }
                }
                foreach($records as $record){
                    if($record['id'] > 7){
                        print_opinion($record);
                    }
                }
            ?>
            </table>

            <?php
        } else{
            echo "<p>No matching reviews found.</p>";
        }
    }
    ?>
</body>
</html>
