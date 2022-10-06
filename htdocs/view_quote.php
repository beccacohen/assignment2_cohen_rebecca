<?php
  //View quotes from the SQLiteDatabase
  include('templates/header.php');

  echo "<h2>View Quotes</h2>";

  //Restrict access to administrators only:
  if (!is_administrator()) {
    echo "<h2>Access Denied</h2>";
    echo "<p class='error'>You do not have permission to access this page.</p>";

    //Includes footer template
    include('templates/footer.php');

    exit();
  }

  //Define query
  $query = "SELECT id, quote, source, favorite FROM quotes ORDER BY date_entered DESC";

  //Run query
  if ($result = mysqli_query($dbc, $query)){

    //Retrieve the return records;
    while ($row = mysqli_fetch_array($result)){
      //Echo quotes
      echo "<div><blockquote>{$row['quote']}</blockquote>-{$row['source']}\n";

      //Is this a favorite?
      if ($row['favorite'] == 1){
        echo "<strong>Favorite!</strong>";
      }

      //Add administrative link
      echo "<p>Quote Admin: <a href=\"edit_quote.php?id={$row['id']}\">Edit</a>
            <a href=\"delete_quote.php?id={$row['id']}\">Delete</a></p></div>";
    }//While loop End
  }else{//Query did not run
    echo "<p class='error'>Could not retrieve the data because: " . mysqli_error($dbc) . "</p>";
    echo "<p>The query being run was: " . $query . "</p>";
  } //End of query IF

  mysqli_close($dbc);

  include('templates/footer.php');

  ?>
