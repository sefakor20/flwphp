<?php
  require './fb-init.php';
?>

<?php if(isset($_SESSION['access_token'])){ ?>
  <center>
    <p>
      <a href="logout.php">Logout</a>
    </p>
  </center>
<?php }else { ?>
  <center>
    <p>
      <a href="<?= $login_url; ?>">Login with Facebook</a>
    </p>
  </center>
<?php } ?>