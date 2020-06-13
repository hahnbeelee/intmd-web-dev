<header>
    <h1 id="title">Hahnbee's Favorite Movies</h1>
    <nav>
        <ul class = "navbar">
            <li>
                <a href="index.php" <?php if($title == "Home") echo "class=chosen";?>>Home</a>
            </li>

            <li>
                <a href="movies.php" <?php if($title == "Movies") echo "class=chosen";?>>The Movies</a>
            </li>

            <li>
                <a href="search.php" <?php if($title== "Search") echo "class=chosen";?>>Search</a>
            </li>

            <li>
                <a href="opinion.php" <?php if($title == "Opinion") echo "class=chosen";?>>Opinion</a>
            </li>
        </ul>
    </nav>
</header>
