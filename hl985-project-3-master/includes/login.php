<!-- Login Form
Source: INFO 2300 Lab 8 -->
<ul>
    <?php
        // include("includes/init.php");
        foreach($session_messages as $message){
            echo "<li><strong>" . htmlspecialchars($message) . "</strong></li>\n";
        }
    ?>
</ul>

<form id="loginForm" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] );?>" method = 'post'>
    <ul>
        <li>
            <label for="username">Username:</label>
            <input id="username" class='next' type="text" name="username" />
        </li>
        <li>
            <label for="password">Password:</label>
            <input id="password" class='next' type="password" name="password"/>
        </li>
        <li>
            <button name="login" type="submit">Sign In</button>
        </li>
    </ul>
</form>
