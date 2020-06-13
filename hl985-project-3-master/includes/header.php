<header>
    <h1 id="title">Dog Gallery</h1>
    <nav>
        <ul class = "navbar">
            <li>
                <a href="index.php" <?php if($title == "Home") echo "class=chosen";?>>Home</a>
            </li>

            <li>
                <a href="gallery.php" <?php if($title == "Gallery") echo "class=chosen";?>>Dog Gallery</a>
            </li>

            <li>
                <a href="upload.php" <?php if($title == "Upload") echo "class=chosen";?>>Upload</a>
            </li>
            <?php
                // Log out
                // Code Source: INFO 2300 Lab 8
                if( is_user_logged_in() ){
                    $logout_url = htmlspecialchars( $_SERVER['PHP_SELF'] ) . '?' . http_build_query(array('logout' => '') );
                    if(isset($_GET['previous'])){
                        $previous = filter_input(INPUT_GET, 'previous', FILTER_SANITIZE_SPECIAL_CHARS);
                        $previous = basename($previous);
                        $logout_url = htmlspecialchars( $previous ) . '?' . http_build_query(array('logout' => '') );
                    }
                    echo '<li id="nav-last"><a href="' . $logout_url . '">Sign Out ' . htmlspecialchars($current_user['username']) . '</a></li>';
                }
            ?>
        </ul>
    </nav>
</header>
