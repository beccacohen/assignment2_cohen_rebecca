<?php //This file defines custom functions

/*==================================

This function checks to see if user is administrator
This function takes two optional values
This function returns Boolean values

=================================*/

function is_administrator($name = 'Rebecca', $value = 'Cohen'){

  //Check for the cookie and check its values

  if(isset($_COOKIE[$name]) && ($_COOKIE[$name] == $value)){
    return true;
  }else{
    return false;
  }
}//ends the is_administrator() function

//Connect define_syslog_variables
$dbc = mysqli_connect('localhost', 'root', 'root', 'form-website');
