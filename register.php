<?php
  include_once 'partial/header.php';

  require_once 'config/db.php';
?>

<section>
  <div class='container'>
    <form action='includes/register.inc.php' method='post'>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" autocomplete="off">
      </div>
      <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="text" class="form-control" name="login" autocomplete="off">
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">User name</label>
        <input type="text" class="form-control" name="name" autocomplete="off">
      </div>
      <div class="mb-3">
        <label for="birth_date" class="form-label">Birth date</label>
        <input type="date" class="form-control" name="birth_date">
      </div>
      <div class="mb-3">
        <label for="country" class="form-label">Country</label>
        <div>
          <select name="country">
          <option value="">Select your country</option>
          <?php
            $query = "SELECT code, countryname FROM country";
            $result = $conn->query($query);
            if($result->num_rows > 0) {
              while($optionData = $result->fetch_assoc()) {
                $option = $optionData['countryname'];
                $id = $optionData['code'];
          ?>
          <option value="<?= $id ?>"><?= $option?></option>
          <?php
            }}
          ?>
        </select>
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" autocomplete="off">
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Password confirm</label>
        <input type="password" class="form-control" name="password_confirm" autocomplete="off">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="check" onchange="document.getElementById('submitBtn').disabled = !this.checked;">
        <label class="form-check-label" for="check">Agree with terms and conditions</label>
      </div>
      <button type="submit" class="btn btn-primary" id='submitBtn' name='submit' disabled>Submit</button>
    </form>
    <p>Have an account? - <a href="index.php">Login</a></p>
  </div>

  <?php
  if(isset($_GET['error'])){
    if($_GET['error'] == 'emptyinputs') {
      echo "
      <div class='container'>
        <div class='alert alert-warning' role='alert'>
          Please, fill all fields
        </div>
      </div>";
    } else if ($_GET['error'] == 'invalidlogin') {
      echo "
      <div class='container'>
        <div class='alert alert-warning' role='alert'>
          Choose another login
        </div>
      </div>";
    } else if ($_GET['error'] == 'invalidemail') {
      echo "
      <div class='container'>
        <div class='alert alert-warning' role='alert'>
          Choose a proper email
        </div>
      </div>";
    } else if ($_GET['error'] == 'passworddontmatch') {
      echo "
      <div class='container'>
        <div class='alert alert-warning' role='alert'>
          Passwords doesn't match!
        </div>
      </div>";
    } else if ($_GET['error'] == 'usertexist') {
      echo "
      <div class='container'>
        <div class='alert alert-warning' role='alert'>
          User with this email or login exist!
        </div>
      </div>";
    } else if ($_GET['error'] == 'stmtfailed') {
      echo "
      <div class='container'>
        <div class='alert alert-warning' role='alert'>
          Something went wrong. Please, try again later
        </div>
      </div>";
    }
  }
?>
</section>
  
<?php
  include_once 'partial/footer.php';
?>
