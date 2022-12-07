<?php

  if(isset($_POST['submit'])) {


    $login = $_POST['login'];
    $userPassword = $_POST['loginPassword'];

    require_once '../config/db.php';
    require_once 'functions.inc.php';

    if (emptyInputsLogin($login, $userPassword) !== false) {
      header('location: ../index.php?error=emptyinputs');
      exit();
    }

    loginUser($conn, $login, $userPassword);

  } else {
    header('location: ../index.php');
    exit();
  }