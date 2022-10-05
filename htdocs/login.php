<?php
  //This page lets people login to the site

  //Set two variable with default values:
  $loggedin = false;
  $error = false;

  //Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Handle the form
    if (!empty($_POST['email']) && !empty($_POST['password'])){

      if((strtolower($_POST['email']) == 'rcohen2@ufl.edu') && ($_POST['password'] == 'disney')){ //Correct

        //Create a cookie
        setcookie('Rebecca', 'Cohen', time()+3600);

        //Indicate they are logged in
        $loggedin = true;
      }else{
        $error = "<p>The submitted email adress and password do not match those on file!</p>";
      }
    }else{
      $error = "<p>Please make sure you enter both an email adress and a password!</p>";
    }
  }

  //Include header template
  include('templates/header.php');

  //Echo errror if it exists
  if($error){
    echo "<p class='error'>$error</p>";
  }

  //Indicate if the user is logged in or show the form
  if ($loggedin) {
    echo "<p>You are now logged in!</p>";
  }else {
    echo '<h2>Login Form</h2>
    <form action="login.php" method="post">
    <p><label>Email Adress <input type="email" name="email"></label></p>
    <p><label>Password <input type="password" name="password"></label></p>
    <p><input type="submit" name="submit" value="Log In!"></p>
    </form>';
  }

include('templates/footer.php'); //Need the footer
?>
