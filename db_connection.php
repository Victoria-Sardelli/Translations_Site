<?php
  function openCon() {
    $dbhost = "us-cdbr-iron-east-05.cleardb.net";
    $dbuser = "b476dc90f94a62";
    $dbpass = "a6f9d8f9";
    $db = "heroku_0fea3be9dd8f318";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db)
      or die("Connect failed: %s\n". $conn -> error);

    return $conn;
  }

  function closeCon($conn) {
    $conn -> close();
  }
?>
