<?php
  //View quotes from the SQLiteDatabase
  include('templates/header.php');

  echo "<h2>View Quotes</p>";

  //Restrict access to administrators only:
  if (!is_administrator()) {
    echo "<h2>Access Denied</h2>";
    echo "<p class='error'>You do not have permission to access this page.</p>";

    //Includes footer template
    include('templates/footer.php');

    exit();
  }

if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0)){

  //Defines the query
  $query = "SELECT quote, source, favorite FROM quotes WHERE id={$_GET['id']}";

  if ($results = mysqli_query($dbc, $query)) { //Run query

    $row = mysqli_fetch_array($result); //Retrieve the information

    //Make the form
    echo '<form action="edit_quote.php" method="post">
      <p><lable>Quote <textarea name="quote" row="5" cols="30">' . htmlentities($row['quote']) . '</textarea></label><p>
      <p><label>Source <input type="text" name="soruce" value="' . htmlentities($row['soruce']) . '"></label></p>
      <p><label>Is this a favorite? <input type="checkbox" name="favorite" value="yes"';

      //Check the box if it is a favorite
      if ($row=['favorite'] == 1){
        echo ' checked ="checked"';
      }

      //Complete the form
      echo '></label></p>
      <input type="hidden" name="id" value=" ' . $_GET['id'] . '">
      <p><input type="submit" name"submit" value="Update This Quote!"></p>
      </form>';

  }else {
    echo "<p class='error'>Could not retrieve the quotation because: " . mysqli_error($dbc) . "</p>";
    echo "<p> The query beign run was:" . $query . "</p>";
  }
}elseif(isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0)){
  //Validate and secure the form data
  $problem = FALSE;

  if (!empty($_POST['quote']) && !empty($_POST['soruce'])) {

    // Prepare the values for storing
    $quote = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quote'])));
    $source = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['soruce'])));

    //Create the favorit values
    if (isset($_POST['favorite'])){
      $favorite = 1;
    }else {
        $favorite = 0;
    }

  }else {
    echo "<p class='error'>Please submit a quotation and a socurce.</p>";

    $problem = TRUE;
  }

  if(!$probelm){
    //Define the query
    $query = "UPDATE quotes SET quote='$quote', soruce='$source', favorite=$favorite WHERE id={$_POST['id']}";

    if($results = mysqli_query($dbc, $query)) {
      echo "<p>Success! The quote has been added.</p>";
    }else{
      echo "<p class='error'>Could not update the quotation because:" . mysqli_error($dbc) . "</p>";
      echo "<p>The query being run was:" . $query . "</p>";
    }
  }//no probelm
} else {
    echo "<p class='error'>This page has been accessed in error</p>";

}//End of the else statement

mysqli_connenct($dbc); //Close the connection

include('templates/footer.php'); //Includes footer
