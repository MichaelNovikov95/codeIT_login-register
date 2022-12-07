<?php
  include_once 'partial/header.php';
  require_once 'config/db.php';

  $id = ($_SESSION['id']);

  if(!isset($id)) {
    header('location: index.php?error=notauthenter');
    exit;
  }

  $user = mysqli_query($conn, "SELECT * FROM users WHERE id='$id';");
  $user = mysqli_fetch_assoc($user);
?>

<h1>Welcome, <?= $user['userName']?></h1>
<h3>Your email: <?= $user['userEmail']?></h3>

<a href="includes/logout.inc.php">Log Out</a>

<?php
  include_once 'partial/footer.php';
?>