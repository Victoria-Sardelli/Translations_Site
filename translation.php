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
      exit("Invalid Category");
    }
    // get id of song we want
    $song_id = -1;
    if(isset($_GET["id"])) {
      $song_id = $_GET["id"];
    }
    // check to see that song id was set
    if ($song_id === -1) {
      exit("<h3>I'm sorry, the page you requested cannot be displayed at this time.</h3>");
    }

    // connect to db that contains translations
    include 'db_connection.php';
    $conn = openCon();
    // set db connection to use UTF-8
    $conn->query("SET NAMES utf8");

    // get specific translation requested using given category and id
    $sql = "SELECT id, name, author, engText, japText, dateAdded
      FROM $cat_name WHERE id = $song_id";
    $result = $conn->query($sql);

    // if the requested translation is found in db, display it
    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      echo "<h1>".$row["name"]."</h1>"; // name of translated work
      echo "<h3>by ".$row["author"]."</h3>"; // name of author
      echo "<div class='trans-text-div'>
              <p class='trans-text'>".nl2br($row["japText"])."</p>"; // japanese text
      echo "  <p class='trans-text'>".nl2br($row["engText"])."</p>
            </div>"; // english text
      echo "<p class='date-added'>Date added: ".date('F j, Y',strtotime($row["dateAdded"]))."</p>"; // date added to db
    } else {
      echo "<h3>I'm sorry, the page you requested cannot be displayed at this time.</h3>";
    }

    // close connection to database
    closeCon($conn);
  ?>
</main>
<?php
  include("includes/bottom.php");
?>
