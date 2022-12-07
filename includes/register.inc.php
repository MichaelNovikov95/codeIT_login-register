<?php

  if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $birth_date = $_POST['birth_date'];
    $country = $_POST['country'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $register_time = time();

    require_once '../config/db.php';
    require_once 'functions.inc.php';

    if (emptyInputs($name, $email, $login, $birth_date, $country, $password, $password_confirm) !== false) {
      header('location: ../register.php?error=emptyinputs');
      exit();
    }
    if (invalidLogin($login) !== false) {
      header('location: ../register.php?error=invalidlogin');
      exit();
    }
    if (invalidEmail($email) !== false) {
      header('location: ../register.php?error=invalidemail');
      exit();
    }
    if (passwordMatch($password, $password_confirm) !== false) {
      header('location: ../register.php?error=passworddontmatch');
      exit();
    }
    if (userExist($conn, $login, $email) !== false) {
      header('location: ../register.php?error=usertexist');
      exit();
    }

    createUser($conn, $name, $email, $login, $birth_date, $country, $password, $register_time);

  } else {
    header('location: ../index.php');
    exit();
  }