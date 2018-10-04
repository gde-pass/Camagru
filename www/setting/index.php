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
