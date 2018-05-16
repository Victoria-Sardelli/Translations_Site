/*
  Changes language of text displayed on translation pages that only display one
  language version at a time. Assigns active class to corresponding lang nav item.
*/
function switchLang(desired_lang) {

  /*
    SWITCH ACTIVE LANGUAGE NAV ITEMS
  */
  // loop through active languages (should only be one but loop just in case)
  var active_navs = document.getElementsByClassName("lang-active");
  for (var i = 0; i < active_navs.length; i++) {
    var active_nav = active_navs[i];
      // remove active-lang class and update elem's classlist
      active_nav.className = active_nav.className.replace(/\blang-active\b/g, "");
  }

  // add active class to desired lang elem if it's not already there
  var desired_nav = document.getElementById(desired_lang);
  if (!desired_nav.className.match(/\blang-active\b/g)) {
    desired_nav.className += " lang-active";
  }

  /*
    SWITCH ACTIVE TEXT ITEMS
  */
  // loop through active texts (should only be one)
  var active_texts = document.getElementsByClassName("text-active");
  for (var i = 0; i < active_texts.length; i++) {
    var active_text = active_texts[i];
      // remove text-active class and update elem's classlist
      active_text.className = active_text.className.replace(/\btext-active\b/g, "");
  }

  // display text corresponding to desired lang (if more than 1, only display 1st)
  var desired_text = document.getElementsByClassName(desired_lang)[0];
  if (!desired_text.className.match(/\btext-active\b/g)) {
    desired_text.className += " text-active";
  }
}
