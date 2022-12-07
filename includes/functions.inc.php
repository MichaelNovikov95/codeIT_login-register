<?php

  function emptyInputs($name, $email, $login, $birth_date, $password, $password_confirm) {
    $result;

    if(empty($name) || empty($email) || empty($login) || empty($birth_date) || empty($password) || empty($password_confirm)){
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  };


  function invalidLogin($login) {
    $result;

    if(!preg_match('/^[a-zA-Z0-9]*$/', $login)){
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  };


  function invalidEmail($email)  {
    $result;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  };


  function passwordMatch($password, $password_confirm)  {
    $result;

    if($password !== $password_confirm){
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  };


  function userExist($conn, $login, $email) {
    $sql = "SELECT * FROM users WHERE userLogin = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
      header('location: ../register.php?error=stmtfailed');
      exit();
    };

    mysqli_stmt_bind_param($stmt, "ss", $login, $email);
    mysqli_stmt_execute($stmt);

    $data = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($data)) {
      return $row;
    } else {
      $result = false;
      return $result;
    }

    mysqli_stmt_close($stmt);
  };


  function createUser($conn, $name, $email, $login, $birth_date, $country, $password, $register_time) {
    $sql = "INSERT INTO users (userName, userEmail, userLogin, userBirthDate, userCountry, userPassword, registerTime) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
      header('location: ../register.php?error=stmtfailed');
      exit();
    };

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $login, $birth_date, $country, $hashedPassword, $register_time);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header('location: ../index.php?error=none');
    exit();
  };

  function emptyInputsLogin($login, $userPassword) {
    $result;

    if(empty($login) || empty($userPassword)){
      $result = true;
    } else {
      $result = false;
    }
    return $result;
  }


  function loginUser($conn, $login, $userPassword) {
    $userExist = userExist($conn, $login, $login);

    if($userExist === false) {
      header('location: ../index.php?error=wronglogin');
      exit();
    }

    $passwordHashed = $userExist['userPassword'];
    $checkPassword = password_verify($userPassword, $passwordHashed);

    if($checkPassword === false) {
      header('location: ../index.php?error=wronglogin');
      exit();

    } else if ($checkPassword === true) {
      session_start();
      $_SESSION['id'] = $userExist['id'];
      $_SESSION['userLogin'] = $userExist['userLogin'];
      header('location: ../userPage.php');
      exit();
    }
  }