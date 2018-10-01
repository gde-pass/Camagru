<?php
session_start();

include '../header.php';
include '../config/database.php';

if ($_SESSION['logged'] == FALSE)
{
    echo "
        <script language='JavaScript' type='text/javascript'>
            window.location.replace('../form/form_login.php?logged=no');
        </script>";
    exit(0);
}
?>

<section class="profile">
  <header class="header">
    <div class="details">
      <img src="/img/icon/default_pp.png" alt="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>" class="profile-pic">
      <h1 class="heading"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h1>
      <div class="nickname">
        <p><?php echo $_SESSION['nickname']; ?></p>
      </div>
    </div>
  </header>
</section>

<?php
include '../footer.php';
?>
