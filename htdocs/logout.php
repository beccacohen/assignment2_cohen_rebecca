<?php
//This is the logout page. It destroys cookies

//Destroy cookies
if(isset($_COOKIE['Cohen'])) {
  setcookie('Cohen', FALSE, time()-300);
}

//Include header
include('templates/header.php');

//Echo a message
echo "<p>You are now logged out</p>";

//Include the footer
include('templates/footer.php');
?>
