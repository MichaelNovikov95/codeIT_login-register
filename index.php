<?php
  include_once 'partial/header.php';

  if(isset($_SESSION['id'])) {
    header('location: userPage.php');
  }
?>

  <div class='container'>
    <form action='includes/login.inc.php' method='POST'>
      <div class="mb-3">
        <label for="login" class="form-label">Email/Login</label>
        <input type="text" class="form-control" name='login' autocomplete="off">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="loginPassword" autocomplete="off">
      </div>
      <button type="submit" class="btn btn-primary" id='submitBtn' name='submit'>Enter</button>
    </form>
    <p>Don't have an account? - <a href="register.php">Sign up</a></p>
</div>

<?php
if(isset($_GET['error'])) {
  if ($_GET['error'] == 'none') {
      echo "
      <div class='container'>
        <div class='alert alert-success' role='alert'>
          You have successfully registered!
        </div>
      </div>
      
      ";
    }
  if ($_GET['error'] == 'emptyinputs') {
    echo "
    <div class='container'>
      <div class='alert alert-danger' role='alert'>
        Please, fill all fields
      </div>
    </div>
      
      ";
    }
  if ($_GET['error'] == 'wronglogin') {
    echo "
    <div class='container'>
      <div class='alert alert-danger' role='alert'>
        Incorrect login information
      </div>
    </div>
      
      ";
    }
  if ($_GET['error'] == 'notauthenter') {
    echo "
    <div class='container'>
      <div class='alert alert-danger' role='alert'>
        Please, sign in first
      </div>
    </div>
      
      ";
    } 
}
?>

<?php
  include_once 'partial/footer.php';
?>