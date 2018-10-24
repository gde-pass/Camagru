<?php
session_start();
include '../header.php';
include '../config/database.php';

function    get_user_preference($nickname)
{
    include '../config/database.php';
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("SELECT `notif` FROM `users` WHERE `nickname` = ?");
    $sql->execute([$nickname]);
    $sql = $sql->fetch(PDO::FETCH_ASSOC);

    return ($sql['notif']);
}

$test = get_user_preference($_SESSION['nickname']);
echo $test;

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

    case 'invalid_first_name':
        echo '<div class="error" style="margin-bottom: 55px;">Invalid first name !</div>';
        break;

    case 'invalid_last_name':
        echo '<div class="error" style="margin-bottom: 55px;">Invalid last name !</div>';
        break;

    case 'invalid_password':
        echo '<div class="error" style="margin-bottom: 55px;">Invalid password !</div>';
        break;

    case 'invalid_email':
        echo '<div class="error" style="margin-bottom: 55px;">Invalid email !</div>';
        break;

    case 'changed':
        echo '<div class="success" style="margin-bottom: 55px;">Settings successfully changed !</div>';
        break;

    case 'email_not_available':
        echo '<div class="warning" style="margin-bottom: 55px;">The email you choose is already taken!</div>';
        break;
}
?>

  <div class='main-content' style="text-align: -webkit-center;">

          <div class='form-forgotten-password-with-email'>

              <div class='form-white-background'>

                  <div class='form-title-row'>
                      <h1>EDIT YOUR PROFILE</h1>
                      <p style="margin-top: 8px;">Please only fill fields you want to update</p>
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

                <form class="form-login" action="../script/update_user_info.php" method="post">

                  <div class="form-row" style="margin-top: 35px">
                      <label>
                          <span>First Name</span>
                          <input type="text" name="firstname" pattern="^[À-ÿa-zA-Z' -]+$" title="You must have more than 2 characters and no special characters" minlength="2" maxlength="255" placeholder="<?= $_SESSION['firstname'] ?>">
                      </label>
                  </div>

                  <div class="form-row">
                      <label>
                          <span>Last Name</span>
                          <input type="text" name="lastname" pattern="^[À-ÿa-zA-Z' -]+$" title="You must have more than 2 characters and no special characters" minlength="2" maxlength="255" placeholder="<?= $_SESSION['lastname'] ?>">
                      </label>
                  </div>

                  <div class="form-row">
                      <label>
                          <span>Email</span>
                          <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" minlength="3" maxlength="254" placeholder="<?= $_SESSION['email'] ?>">
                      </label>
                  </div>

                  <div class='form-row'>
                      <label>
                          <span>New Password</span>
                          <input type='password' name='new_password'  minlength='6' title="You must have more than 6 characters, a capital and tiny letter" maxlength='20' pattern='((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})' placeholder="*******">
                      </label>
                  </div>

                  <div class='form-row'>
                      <label>
                          <span>Notifications</span>
                          <input style="margin-left: 80px; width: 14px;" type='checkbox' <?php if (get_user_preference($_SESSION['nickname']) == 1){ echo "checked";} ?> name='notif'>
                      </label>
                  </div>

                  <div class="form-row" style="text-align: center">
                      <button type="submit">Save settings</button>
                  </div>

                  </form>

                  <form action="/script/script_delaccount.php" method="post">
                      <button type="submit" name="button" class="button" style="background-color:red">DELETE YOUR ACCOUNT</button>
                  </form>
              </div>
          </div>
    </div>

<script>
  function changeImg(image)
  {
    document.form.submit();
  }
</script>

<?php
include '../footer.php';
?>
