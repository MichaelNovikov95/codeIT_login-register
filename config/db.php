<?php

//for localhost
  $server = 'localhost';
  $username = 'root';
  $db_password = 'root';
  $dbName = 'login_system';

//for host
  // $server = 'localhost';
  // $username = 'hostingcodeIT_db';
  // $db_password = '!Q2w3e4r5t6y';
  // $dbName = 'mykhailonovikov';

  $conn = mysqli_connect($server, $username, $db_password, $dbName);

  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }