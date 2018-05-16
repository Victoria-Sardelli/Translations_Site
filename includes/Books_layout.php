<?php
  // if the requested translation is found in db, display it
  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    echo "<h1>".$row["name"]."</h1>"; // name of translated work
    echo "<h3>by ".$row["author"]."</h3>"; // name of author
    echo "<div class='book-text-div'>";
    echo  "<ul class='lang-nav'>
            <li id='jap' class='lang-nav-item lang-active' onclick='switchLang(this.id)'>
              <a href='javascript:void(0);'>日本語</a></li>
            <li id='eng' class='lang-nav-item' onclick='switchLang(this.id)'>
              <a href='javascript:void(0);'>English</a></li>
          </ul>"; // nav to switch between languages
    echo " <p class='jap book-text text-active'>".nl2br($row["japText"])."</p>"; // japanese text
    echo " <p class='eng book-text'>".nl2br($row["engText"])."</p>
          </div>"; // english text
    echo "<p class='date-added'>Date added: ".date('F j, Y',strtotime($row["dateAdded"]))."</p>"; // date added to db
  } else {
    echo "<h3>I'm sorry, the page you requested cannot be displayed at this time.</h3>";
  }
  echo "<script type='text/javascript' src='js/translation.js'></script>";
?>
