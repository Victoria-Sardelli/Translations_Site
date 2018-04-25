<?php
  function openCon() {
    $dbhost = getenv("dbhost");
    $dbuser = getenv("dbuser");
    $dbpass = getenv("dbpass");
    $db = getenv("db");

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db)
      or die("Connect failed: %s\n". $conn -> error);

    return $conn;
  }

  function closeCon($conn) {
    $conn -> close();
  }
?>
