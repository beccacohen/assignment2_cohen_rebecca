    <?php
    //Adds quotes to database
    include('templates/header.php');

    echo "<h2>Add a Quotation</h2>";

    //Restrict access to administrators only:
    if(!is_administrator()){
      echo "<h2>Access Denied</h2>";
      echo "<p class='error'>You do not have access to this page.</p>";

      //Include footer template
      include('templates/footer.php');

      exit();
    }

    if($_SERVER['REQUEST_METHOD']== 'POST'){
      if(!empty($_POST['quote']) && !empty($_POST['source'])){


        //Prepare the value for storing
        $quote = mysqli_real_escape_string($dbc, trim(strip_tag($_POST['quote'])));
        $source = mysqli_real_escape_string($dbc, trim(strip_tag($_POST['source'])));

        //Create favorite value
        if (isset($_POST['favorite'])){
          $favorite = 1;
        }else {
          $favorite = 0;
        }

        $query = "INSERT INTO quotes (quotes,source,favorite) VALUES ('$quotes', '$source', $favorite)";

        if (mysqli_affected_rows($dbc) ==1) {
          //echo out message
          echo "<p>YOur Quotation has been stored</p>";
        }else {
          echo "<p class='error'>Could not store the qutoe because:" . mysqli_error($dbc) . "</p>";
          echo "<p>The query being run was:" . $query . "</p>";
        }

        //Close connection
        mysqli_close($dbc);
      }else {  //Failed to enter a quotation or source
        echo "<p class='error'>Please enter a quotation and source</p>";
      }
    } //End of if statement
?>

  <form action="add_quote.php" method="post">
    <p><lable>Quote <textarea name="quote" rows="5" cols="30"></textarea></label></p>
    <p><lable>Source <input type="text" name="source"></lable></p>
    <p><label>Is this a favorite? <input type="checkbox" name="favorite" value="yes"></label></p>
    <p><input type="submit" name="submit" value="Add this Quote!"></p>
  </form>

<?php include('tempates/footer.php'); ?>
