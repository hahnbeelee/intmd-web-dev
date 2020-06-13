<?php
    // movies page
    function print_img($img, $title){
        echo "<img class='table-pic' src='images/$img' alt='$title'>";
    }

    function print_source($source){
        echo "<div><cite><a href='$source'>Source</a></cite></div>";
    }
    function print_inCode_source($source){
        echo "<!-- Source: $source -->";
    }

    function print_record($record) {
        $genres = array(
            "Romance", "Horror", "Fantasy", "Animation"
        );
        $posters = array(
            "lalaland.jpg","hereditary.png", "exmachina.jpg", "annihilation.jpg", "spiderverse.jpg", "homecoming.jpg", "perfectblue.jpg", "astarisborn.jpg"
        );
        $sources = array(
            "https://www.fandangonow.com/player/trailer/MMV152CA0FF50713E014BF44ABE5811884C8",
            "https://www.imdb.com/title/tt7784604/",
            "https://www.amazon.com/Machina-Original-Movie-Poster-Double/dp/B00ZUDS11W", "https://www.imdb.com/title/tt2798920/",
            "https://www.amazon.com/SPIDER-MAN-SPIDER-VERSE-POSTER-ORIGINAL-Advance/dp/B07GJR2ZSD",
            "https://www.amazon.com/Posters-USA-Spider-Homecoming-Poster/dp/B06XXQ7RDQ", "https://www.pinterest.com/pin/445012006912080956/?lp=true",
            "https://www.amazon.com/STAR-Original-Movie-Poster-27x40/dp/B07DVS7FTZ"
        );

        ?>
        <tr>
            <td>
            <?php
                print_inCode_source($sources[$record["id"]]);
                print_img($posters[$record["id"]], $record["name"]);
                print_source($sources[$record["id"]]);
                echo htmlspecialchars($record["name"]);
            ?>
            </td>
            <td><?php echo htmlspecialchars($record["release_date"]);?></td>
            <td><?php echo htmlspecialchars($record["rating"]) . "%";?></td>
            <td><?php echo htmlspecialchars($genres[$record["genre"]]);?></td>
            <td><?php echo htmlspecialchars($record["description"]);?></td>
            <td><?php echo htmlspecialchars($record["opinion"]);?></td>
        </tr>
    <?php
    }

    function print_opinion($opinion){
        $db = open_sqlite_db("secure/data.sqlite");
        $sql = "SELECT id, name FROM movies WHERE (id < 8);";

        $params = array();
        $result = exec_sql_query($db, $sql, $params);

        $records = $result->fetchAll();

        $posters = array(
            "lalaland.jpg","hereditary.png", "exmachina.jpg", "annihilation.jpg", "spiderverse.jpg", "homecoming.jpg", "perfectblue.jpg", "astarisborn.jpg"
        );
        $sources = array(
            "https://www.fandangonow.com/player/trailer/MMV152CA0FF50713E014BF44ABE5811884C8",
            "https://www.imdb.com/title/tt7784604/",
            "https://www.amazon.com/Machina-Original-Movie-Poster-Double/dp/B00ZUDS11W", "https://www.imdb.com/title/tt2798920/",
            "https://www.amazon.com/SPIDER-MAN-SPIDER-VERSE-POSTER-ORIGINAL-Advance/dp/B07GJR2ZSD",
            "https://www.amazon.com/Posters-USA-Spider-Homecoming-Poster/dp/B06XXQ7RDQ", "https://www.pinterest.com/pin/445012006912080956/?lp=true",
            "https://www.amazon.com/STAR-Original-Movie-Poster-27x40/dp/B07DVS7FTZ"
        );
        ?>
        <tr>
            <td>
            <?php
            foreach($records as $record){
                if($record['name'] == $opinion["name"]){
                    $index = $record['id'];
                    print_inCode_source($sources[$index]);
                    print_img($posters[$index], $opinion["name"]);
                    print_source($sources[$index]);
                    echo htmlspecialchars($opinion["name"]);
                }
            }
            ?>
            </td>
            <td><?php echo htmlspecialchars($opinion["opinion"]);?></td>
        </tr>
    <?php
    }
?>
