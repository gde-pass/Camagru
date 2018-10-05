<?php
 include '../header.php';
 if ($_SESSION['logged'] == FALSE)
 {
   header('Location: ../form/form_login.php?logged=no');
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
         echo '<div class="error" style="margin-bottom: 55px;">Your picture is to heavy, please upload a picture under 100Ko</div>';
         break;
    case 'empty':
         echo '<div class="error" style="margin-bottom: 55px;">You sent nothing !</div>';
         break;
    case 'invalid_name':
      echo '<div class="error" style="margin-bottom: 55px;">Invalid name !</div>';
      break;
    case 'invalid_password':
      echo '<div class="error" style="margin-bottom: 55px;">Invalid password !</div>';
      break;
    case 'name_change':
      echo '<div class="success" style="margin-bottom: 55px;">Name successfully changed !</div>';
      break;
}
?>

<section class="profile">
  <header class="header">
    <div id="details">
      <form name="form" method="POST" enctype="multipart/form-data" action="../script/setting.php">
        <label for="file-input">
          <img id="avatar" src="data:image/png;base64,<?= $_SESSION['avatar'] ?>" alt="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>" class="profile-pic" style="cursor: pointer;" onmouseover="this.src='/img/icon/folder.png'" onmouseout="this.src='data:image/png;base64,<?= $_SESSION['avatar'] ?>'">
        </label>
        <input id='file-input' name="avatar" type='file' accept="image/*" onchange="changeImg()" hidden>
        <input type="submit" name="Change" id="change" hidden>
      </form>
    </div>
  </header>
</section>

<div class="main-content">
<div class="form-forgotten-password">
    <div class="form-title-row">
        <h1>Edit your profile</h1>
    </div>

<form class="form-register" action="/script/script_change_name.php" method="POST">
    <div class="form-row">
        <label>
            <span>Change firstname : </span>
    <input type="input" name="firstname" placeholder="<?= $_SESSION['firstname']?>" class="input-setting" />
</label>
</div>
<div class="form-row">
    <label>
        <span>Change lastname : </span>
    <input type="input" name="lastname" placeholder="<?= $_SESSION['lastname']?>" class="input-setting"/>
</label>
</div>
    <input type="submit" hidden>
</form>
</div>
<form class="form-forgotten-password" action="/script/script_change_password_logged.php" method="POST">
    <div class="form-row">
        <label>
            <span>Change Password 🔒 : </span>
  <input type="password" placeholder="New Password" name='password' class="input-setting" required>
</label>
</div>
</form>
<BR />
<form action="/script/script_delaccount.php" method="post">
      <button type="submit" name="button" class="button" style="background-color:red">DELETE YOUR ACCOUNT</button>
</form>
</div>

<script>

  function changeImg(image) {
    document.form.submit();
  }
</script>

<?
 include '../footer.php';
?>
