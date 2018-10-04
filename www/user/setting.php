<?php
 include '../header.php';
 if ($_SESSION['logged'] == FALSE)
 {
     echo "
         <script language='JavaScript' type='text/javascript'>
             window.location.replace('../form/form_login.php?logged=no');
         </script>";
     exit(0);
 }

 switch ($_GET['msg'])
 {
     case 'uploaded':
         echo '<div class="success" style="margin-bottom: 55px;">Picture successfully uploaded</div>';
         break;

     case 'invalid_extension':
         echo '<div class="error" style="margin-bottom: 55px;">You tried to upload a invalid extension, please use png, jpeg, jpg or gif</div>';
         break;
     case 'to_heavy':
         echo '<div class="error" style="margin-bottom: 55px;">Your picture is to heavy, please upload a picture under 2Mo</div>';
         break;
     case 'empty':
         echo '<div class="error" style="margin-bottom: 55px;">You sent nothing !</div>';
         break;
}
?>

<section class="profile">
  <header class="header">
    <div class="details">
      <form name="form" method="POST" enctype="multipart/form-data" action="../script/setting.php">
      <label for="file-input">
        <img id="avatar" src="data:image/png;base64,<?= $_SESSION['avatar'] ?>" alt="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>" class="profile-pic" style="cursor: pointer;" onmouseover="this.src='/img/icon/folder.png'" onmouseout="this.src='data:image/png;base64,<?= $_SESSION['avatar'] ?>'">
      </label>
      <input id='file-input' name="avatar" type='file' accept="image/*" onchange="changeImg()" hidden>
      <input type="submit" name="Change" id="change" hidden>
    </form>
      <h1 class="heading"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h1>
      <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="<?php echo $_SESSION['nickname']?>" aria-label="Recipient's username" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Change</button>
  </div>
</div>
    </div>
  </header>
</section>

<script>

  function changeImg(image) {
    document.form.submit();
  }
</script>

<?
 include '../footer.php';
?>
