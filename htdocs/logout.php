<?php
//This is the logout page. It destroys cookies

//Destroy cookies
if(isset($_COOKIE['Rebecca'])) {
  setcookie('Rebecca', FALSE, time()-300);
}

//Include header
include('templates/header.php');

//Echo a message
echo "<p>You are now logged out</p>";

//Include the footer
include('templates/footer.php');
?>
