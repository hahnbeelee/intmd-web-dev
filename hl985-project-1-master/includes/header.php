<header>
    <div class = "page-title">
        <?php echo $title; ?>
    </div>
    <nav>
        <ul>
            <li>
                <a href="index.php" <?php if($title == "Home") echo "class=chosen";?>>
                Home</a>
            </li>

            <li><a href="nature.php" <?php if($title == "Nature") echo "class=chosen";?>>
                Nature</a>
            </li>

            <li><a href="portraits.php" <?php if($title == "Portraits") echo "class=chosen";?>>
                Portraits</a>
            </li>

            <li><a href="misc.php" <?php if($title == "Misc") echo "class=chosen";?>>
                Misc</a>
            </li>

            <li><a href="contact.php" <?php if($title == "Contact") echo "class=chosen";?>>
                Contact</a>
            </li>
        </ul>
    </nav>


</header>
