<?php
class Paginator {
  private $_conn;
  private $_query;
  private $_total;
  private $_page;
  private $_limit;

  /*
    Paginator constructor
    $conn = db connection
    $query = db query
  */
  public function __construct($conn, $query) {
    $this->_conn = $conn;
    $this->_query = $query;

    $result = $this->_conn->query($this->_query);
    $this->_total = $result->num_rows;
  }

  /*
    Gets results of db query based on limit and page specified
  */
  public function getData($page, $limit) {
    // have obj keep track of curr page and limit
    $this->_page = $page;
    $this->_limit = $limit;

    // calculate start row for given page
    $start_row = $limit * ($page - 1);
    // make full query with limit
    $query = $this->_query . " LIMIT $start_row,$limit";
    // get results of query
    $results = $this->_conn->query($query);
    return $results;
  }

  /*
    Displays links to other pages
    $class = class to add to links
  */
  public function createLinks($container_class, $link_class) {
    // get all $_GET variables from url except page
    $url_vars = $_GET;

    // determine number of last page
    $last_page = ceil($this->_total / $this->_limit);

    /*
      create html for previous button
    */
    $url_vars["page"] = $this->_page > 1 ? $this->_page - 1 : 1;
    $new_query_str = http_build_query($url_vars);
    // if we are on page 1, disable prev button
    $prev_class = $this->_page == 1 ?
      ($link_class . " disable") : $link_class;
    $prev_html = "<li class='$prev_class'>
      <a href='?$new_query_str'>Prev</a></li>";

    /*
       create html for page links.
       current page will be in the center,
       surrounded by up to $this->_links num of link options
    */


    /*
      create html for next button
    */
    $url_vars["page"] = $this->_page > $last_page ?
      $last_page : $this->_page + 1;
    $new_query_str = http_build_query($url_vars);
    // if we are on last page, disable prev button
    $next_class = $this->_page == $last_page ?
      ($link_class . " disable") : $link_class;
    $next_html = "<li class='$next_class'>
      <a href='?$new_query_str'>Next</a></li>";


    // put all html together and echo
    echo "<ul class='$container_class'>".
        $prev_html.
        $next_html.
        "</ul>";
  }
}
?>
