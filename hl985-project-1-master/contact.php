<?php
  include("includes/init.php");
  $title = "Contact";

  if(isset($_POST['submit'])){
    $valid = TRUE;

    $name = $_POST['order_name'];
    if($name == ''){
      $valid = FALSE;
    }

    $email = $_POST['order_email'];
    if($email == ''){
      $valid = FALSE;
    }

    $number = $_POST['order_number'];

    $comment = $_POST['order_comment'];
    if($comment == ''){
      $valid = FALSE;
    }
    $socialMedia = $_POST['order_socialMedia'];
  }else{
    $name = '';
    $email = '';
    $number = '';
    $comment = '';
    $socialMedia = '';
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Contact</title>

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
</head>

<body>
  <?php include("includes/header.php"); ?>

  <div class="main">
  <?php
    if ( isset($valid) && $valid ) { ?>

      <!-- confirmation page. -->
      <div id=confirmation>
        <h2>Thank you for your comment <?php echo $name; ?>!</h2>

        <p>
          Name: <?php echo $name;?>
        </p>
        <p>
          Email: <?php echo $email;?>
        </p>
        <p>
          Number: <?php echo $number;?>
        </p>
        <p>
          Comment: <?php echo $comment;?>
        </p>
        <p>
          Social Media: <?php echo $socialMedia;?>
        </p>
      </div>

    <?php } else { ?>

      <form id="contact-form" method="post" action="contact.php">
        <fieldset>
          <legend>Contact</legend>
          <div>*Indicates required field</div>

          <p>
            <label for="name_field">Name*: </label>
            <input id="name_field" name="order_name" type="text" value="<?php echo htmlspecialchars($name); ?>"/>

            <?php
              if($name == '' && isset($_POST['submit'])) {
                echo "<p class=\"form_error\">Please provide a name.</p>";
              }
            ?>
          </p>

          <p>
              <label for="email_field">Email*: </label>
              <input id="email_field" name="order_email" type="email" value="<?php echo htmlspecialchars($email); ?>"/>

              <?php
                if($email == '' && isset($_POST['submit'])) {
                  echo "<p class=\"form_error\">Please provide an email.</p>";
                }
              ?>
          </p>

          <p>
              <label for="number_field">Number: </label>
              <input id="number_field" name="order_number" type="number" value="<?php echo htmlspecialchars($number); ?>"/>
          </p>

          <p>
              <label for="comment_field">Comment*: </label>
              <input id="comment_field" name="order_comment" type="text" value="<?php echo htmlspecialchars($comment); ?>"/>

              <?php
                if($comment == '' && isset($_POST['submit'])) {
                  echo "<p class=\"form_error\">Please provide a comment.</p>";
                }
              ?>
          </p>

          <p>
              <label for="socialMedia_field">Social Media Handles: </label>
              <input id="socialMedia_field" name="order_socialMedia" type="text" value="<?php echo htmlspecialchars($socialMedia); ?>"/>
          </p>

          <input name="submit" type="submit" value="Submit"/>
        </fieldset>
      </form>
    <?php } ?>
  </div>
</body>
</html>
