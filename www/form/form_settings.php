<?php
session_start();
if ($_SESSION['logged'] == FALSE || $_SESSION['twitter'] == "TRUE")
{
  header('Location: ../form/form_login.php?logged=no');
  exit(0);
}
include '../header.php';
include '../config/database.php';


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

  <div class='main-content' style="text-align: -webkit-center;">

          <div class='form-forgotten-password-with-email'>

              <div class='form-white-background'>

                  <div class='form-title-row'>
                      <h1>EDIT YOUR PROFILE</h1>
                  </div>

                  <div class="form-row" style="text-align: center;">
                      <form name="form" method="POST" enctype="multipart/form-data" action="../script/setting.php">
                          <label for="file-input">
                            <img style="text-align: center;" id="avatar" src="data:image/png;base64,<?= $_SESSION['avatar'] ?>" alt="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>" class="profile-pic" style="cursor: pointer;" onmouseover="this.src='/img/icon/folder.png'" onmouseout="this.src='data:image/png;base64,<?= $_SESSION['avatar'] ?>'">
                          </label>
                          <input id='file-input' name="avatar" type='file' accept="image/*" onchange="changeImg()" hidden>
                          <input type="submit" name="Change" id="change" hidden>
                        </form>
                  </div>
<form class="form-register" action="/script/script_change_name.php" method="POST">
                  <div class="form-row">
                      <label>
                          <span>First Name</span>
                          <input type="text" name="firstname"  pattern="^[À-ÿa-zA-Z' -]+$" title="You must have more of 2 characters and no special characters" minlength="2" maxlength="255" placeholder="<?= $_SESSION['firstname'] ?>">
                      </label>
                  </div>

                  <div class="form-row">
                      <label>
                          <span>Last Name</span>
                          <input type="text" name="lastname"  pattern="^[À-ÿa-zA-Z' -]+$" title="You must have more of 2 characters and no special characters" minlength="2" maxlength="255" placeholder="<?= $_SESSION['lastname'] ?>">
                      </label>
                  </div>
                  <input type="submit" hidden>
</form>
<form class="form-forgotten-password" action="/script/script_change_password_logged.php" method="POST">
                  <div class='form-row'>
                      <label>
                          <span>Password</span>
                          <input type='password' name='password'  minlength='6' title="You must have more of 6 characters and no special characters" maxlength='20' pattern='((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})' placeholder="*******">
                      </label>
                  </div>
</form>
              </div>

          </div>

<form action="/script/script_delaccount.php" method="post">
      <button type="submit" name="button" class="button" style="background-color:red">DELETE YOUR ACCOUNT</button>
</form>
<script>
  function changeImg(image) {
    document.form.submit();
  }
</script>
<?php
include '../footer.php';
?>
