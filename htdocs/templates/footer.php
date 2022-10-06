<?php
    //Display general admin links
    if((is_administrator()) || (isset($loggedin) && $loggedin)) {
      // Create links to dsiplay
      echo '<hr><h3>Site Admin</h3>
      <p><a href="add_quote.php">Add Quote</a> | <a href="view_quote.php">View Quote</a> | <a href="logout.php">Logout</a></p>';
    }
    ?>
    </div>
    <footer id="footer">Content &copy; <?php echo date('Y'); ?> </footer>
  </body>
</html>
