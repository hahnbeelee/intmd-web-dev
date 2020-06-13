<?php
// $button = true if you want to show button for removing image

// for showing all images

    function print_image_table($images, $button){

        ?>
        <table>
        <tr>
        <?php
        $i = 1;
        foreach($images as $image){
            if($i % 3 == 0){
                print_table_img($image, $button);
                $i++;
            ?>
        </tr>
        <tr>
        <?php
            }elseif($image['id'] == sizeof($images)){
                print_table_img($image, $button);
                $i++;
        ?>
        </tr>
        <?php
            }else{
                print_table_img($image, $button);
                $i++;
            }
        }
        ?>
        </table>
        <?php
    }
    function print_table_img($image, $button){
        ?>

        <td>
        <?php
            echo "<!-- Source:" . htmlspecialchars($image['source']) . "-->";

            $array1 = array(
                'pic-id' => $image['id'],
                'previous' => $_SERVER['REQUEST_URI']
            );
            ?>
            <a href="image.php?<?php echo http_build_query( $array1 ); ?>"> <img class='table-pic' src="uploads/images/<?php echo htmlspecialchars($image['id']) . "." . htmlspecialchars($image['ext']); ?>" alt='<?php echo htmlspecialchars($image['description']);?>' > </a>
            <?php
            echo "<div><cite><a href='" . htmlspecialchars($image['source']) . "'>Source</a></cite></div>";
            echo "<div>" . htmlspecialchars($image['description']) . "</div>";
            print_tags($image['id'], $button);
            if($button){
                $array = array(
                    'pic-id' => $image['id'],
                    'delete' => TRUE
                );
            ?>
                <a id='button' href= "<?php echo htmlspecialchars(basename($_SERVER['PHP_SELF'])) . "?" . http_build_query($array) ;?>">Delete</a>
            <?php
            }
        ?>
        </td>
        <?php
    }

    function print_img($image){
        echo "<img class='table-pic' src='uploads/images/" . htmlspecialchars($image['id']) ."." . htmlspecialchars($image['ext']) . "' alt='" . htmlspecialchars($image['description']) . "'>";
    }

    function print_tags($image_id, $button){
        global $db;
        global $title;
        $sql = "SELECT tags.id, tags.tag, image_tags.image_id FROM tags INNER JOIN image_tags ON tags.id = image_tags.tag_id WHERE image_tags.image_id = :image_id";
        $params = array(
            ':image_id' => $image_id
        );
        $tags = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);
        if($tags){
            echo "Tags: ";
            $i = 1;
            foreach($tags as $tag){
                if($i < sizeOf($tags)){
                    echo htmlspecialchars($tag['tag']);
                    if($button){
                        echo " <a href='upload.php?" . http_build_query(array( 'remove' => TRUE, 'tag_id' => $tag['id'], 'img_id' => $image_id)) . "'>[remove]</a>";
                    }
                    echo ", ";
                    $i++;
                }else{
                    echo $tag['tag'] . " ";
                    if($button){
                        echo "<a href='upload.php?" . http_build_query(array( 'remove' => TRUE, 'tag_id' => $tag['id'], 'img_id' => $image_id)) . "'> [remove]</a>";
                    }

                }
            }
        }
        if($title != 'Add Tag'){
        ?>
            <a href='add_tag.php?<?php echo http_build_query( array('add_tag' => TRUE, 'img_id' => $image_id, 'previous' => $_SERVER['REQUEST_URI'])) ;?>'>Add Tag</a>
        <?php
        }
    }
?>
