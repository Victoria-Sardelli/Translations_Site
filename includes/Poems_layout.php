<?php
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
?>
