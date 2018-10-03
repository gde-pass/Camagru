<?php
session_start();

include '../header.php';
include '../config/database.php';
?>

  <div class='main-content'>

      <form class='form-forgotten-password' method='post' action='/script/script_settings.php'>

          <div class='form-forgotten-password-with-email'>

              <div class='form-white-background'>

                  <div class='form-title-row'>
                      <h1>EDIT YOUR PROFILE</h1>
                  </div>

                  <div class="form-row">
                      <label>
                          <span>Avatar</span>
                          <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                      </label>
                  </div>

                  <div class="form-row">
                      <label>
                          <span>First Name</span>
                          <input type="text" name="firstname"  pattern="^[À-ÿa-zA-Z' -]+$" minlength="2" maxlength="255" placeholder="<?= $_SESSION['firstname'] ?>">
                      </label>
                  </div>

                  <div class="form-row">
                      <label>
                          <span>Last Name</span>
                          <input type="text" name="lastname"  pattern="^[À-ÿa-zA-Z' -]+$" minlength="2" maxlength="255" placeholder="<?= $_SESSION['lastname'] ?>">
                      </label>
                  </div>

                  <div class="form-row">
                      <label>
                          <span>Nickname</span>
                          <input type="text" name="nickname"  pattern="^[0-9a-zA-Z'-]+$" minlength="2" maxlength="30" placeholder="<?= $_SESSION['nickname'] ?>">
                      </label>
                  </div>

                  <div class="form-row">
                      <label>
                          <span>Email</span>
                          <input type="email" name="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" minlength="3" maxlength="254" placeholder="<?= $_SESSION['email'] ?>">
                      </label>
                  </div>

                  <div class='form-row'>
                      <label>
                          <span>Password</span>
                          <input type='password' name='password'  minlength='6' maxlength='20' pattern='((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})' placeholder="*******">
                      </label>
                  </div>



                  <div class='form-row'>
                      <button type='submit'>OK</button>
                  </div>

              </div>

          </div>

      </form>

<form action="/script/script_delaccount.php" method="post">
      <button type="submit" name="button" class="button" style="background-color:red">DELETE YOUR ACCOUNT</button>
</form>

<?php
include '../footer.php';
?>
