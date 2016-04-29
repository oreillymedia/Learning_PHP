<?php
// Start sessions first thing so we can use $_SESSION freely later.
session_start();
?>
<html>
  <head><title>Background Color Example</title>
  <body style="background-color:<?= $_SESSION['background_color'] ?>">
    <p>What color did you pick?</p>
  </body>
</html>
