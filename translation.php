<!-- displays a translation pair  -->
<?php
  include("includes/top.php");
?>
<link rel="stylesheet" href="stylesheets/translation.css">
<?php
  include("includes/header.php");
?>
<main class="main-content">
  <?php
    // get name of category we want
    $cat_name = "";
    if(isset($_GET["catName"])) {
      $cat_name = $_GET["catName"];
    }
    // check value of category name
    if ($cat_name != "Songs" && $cat_name != "Books" && $cat_name != "Poems") {
      exit("<h3>I'm sorry, the page you requested cannot be displayed at this time.</h3>");
    }
    // get id of translation we want
    $trans_id = -1;
    if(isset($_GET["id"])) {
      $trans_id = $_GET["id"];
    }
    // check to see that song id was set
    if ($trans_id === -1) {
      exit("<h3>I'm sorry, the page you requested cannot be displayed at this time.</h3>");
    }

    // connect to db that contains translations
    include 'db_connection.php';
    $conn = openCon();
    // set db connection to use UTF-8
    $conn->query("SET NAMES utf8");

    // get specific translation requested using given category and id
    $sql = "SELECT id, name, author, engText, japText, dateAdded
      FROM $cat_name WHERE id = $trans_id";
    $result = $conn->query($sql);

    // display results but layout may be different depending on category
    include($cat_name.'_layout.php');

    // close connection to database
    closeCon($conn);
  ?>
</main>
<?php
  include("includes/bottom.php");
?>
