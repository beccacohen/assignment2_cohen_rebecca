<?php
  /*This is the home page of the website. It displays:
  The most recent quote(default)
  OR, a random quote
  OR, a random favorite quote*/

  //Include the header
  include('templates/header.php');

  //Define the query
if (isset($_GET['random'])){
  $query = "SELECT id, quote, source, favorite FROM quotes ORDER BY RAND() DESC LIMIT 1";
}elseif(isset($_GET['favorite'])) {
  $query = "SELECT id, quote, source, favorite FROM quotes WHERE favorite=1 ORDER BY RAND() DESC LIMIT 1";
}else{
  $query = "SELECT id, quote, source, favorite FROM quotes ORDER BY date_entered DESC LIMIT 1";
}

//Run the query
if($result = mysqli_query($dbc, $query)){

  // Retrieve the returned record
  $row = mysqli_fetch_array($result);

  //Display the record (quote)
  echo "<div><blockquote>{$row['quote']}</blockquote>- {$row['source']}";

  //Is this a favorite
  if($row['favorite'] == 1){
    echo "<strong>Favorite!</strong>";
  }

  //close div
  echo "</div>";

  //if admin is logged in, show links for the quotes
  if (is_administrator()){
    echo "<p>Quote Admin: <a href=\"edit_quote.php?id={$row['id']}\"Edit</a> | <a href=\"delete_quote.php?id={$row['id']}\>Delete</a></p>\n";
  }
}else {
  echo "<p>Could not retrieve the data because: " . mysqli_error($dbc) . "</p>";
  echo "<p>The query being was: " . $query . "</p>";
}

mysqli_close($dbc); //close connection

echo '<p><a href="index.php">Latest</a> | <a href="index.php?random=true">Random</a> | <a href="index.php?favorite=true">Favorite</a></p>';

include('templates/footer.php');
?>
