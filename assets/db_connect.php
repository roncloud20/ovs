<?php
  // Connect to MySQL database
  $conn = mysqli_connect('localhost', 'root', '', 'inec');

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>