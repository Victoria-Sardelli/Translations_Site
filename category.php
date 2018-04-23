<!-- displays list of existing translations for this category -->
<?php
  include("includes/top.php");
?>
<link rel="stylesheet" href="./stylesheets/category.css">
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
    // display category name as title on top
    echo "<h1>$cat_name Category Page</h1>";

    // connect to db that contains translations
    include 'db_connection.php';
    $conn = openCon();
    // set db connection to use UTF-8
    $conn->query("SET NAMES utf8");
    // get all translations for this category
    $sql = "SELECT id, name, author, engText, japText, dateAdded
            FROM $cat_name ORDER BY dateAdded DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // display link to each translation in this category
      while($row = $result->fetch_assoc()) {
        echo '<a class="trans-link"'
          .' href="./translation.php?catName='.$cat_name
          .'&id='.$row["id"].'">'.$row["name"].'</a><br>';
      }
    } else {
      echo "No translations added yet. Check back soon!";
    }

    // close connection to database
    closeCon($conn);
  ?>
</main>
<?php
  include("includes/bottom.php");
?>
