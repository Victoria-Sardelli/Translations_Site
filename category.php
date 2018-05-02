<!-- displays list of existing translations for this category -->
<?php
  include("includes/top.php");
?>
<link rel="stylesheet" href="./stylesheets/category.css">
<link rel="stylesheet" href="./stylesheets/pagination.css">
<?php
  include("includes/header.php");
?>
<main class="main-content">
  <?php
    require_once 'pagination.php';
    // get name of category we want
    $cat_name = "";
    if(isset($_GET["catName"])) {
      $cat_name = $_GET["catName"];
    }
    // check value of category name
    if ($cat_name != "Songs" && $cat_name != "Books" && $cat_name != "Poems") {
      exit("<h3>I'm sorry, the page you requested cannot be displayed at this time.</h3>");
    }
    // display category name as title on top
    echo "<h1>$cat_name</h1>";

    // connect to db that contains translations
    include("./db_connection.php");
    $conn = openCon();
    // set db connection to use UTF-8
    $conn->query("SET NAMES utf8");
    // get all translations for this category
    $sql = "SELECT id, name, author, engText, japText, dateAdded
            FROM $cat_name ORDER BY dateAdded DESC";

    // try new pagination class
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 2;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $links = isset($_GET['links']) ? $_GET['links'] : 5;
    $Paginator = new Paginator($conn, $sql);
    $result = $Paginator->getData($page, $limit);

    if ($result->num_rows > 0) {
      echo "<div class='results'>";
      // display link to each translation in this category
      while($row = $result->fetch_assoc()) {
        echo '<a class="trans-link"'
          .' href="./translation.php?catName='.$cat_name
          .'&id='.$row["id"].'">'.$row["name"].'</a><br>';
      }
      echo "</div>";
      $Paginator->createLinks("page-links-div", "page-link");
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
