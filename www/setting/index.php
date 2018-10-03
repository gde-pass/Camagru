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
      <label for="file-input">
        <img src="data:image/png;base64,<?= $_SESSION['avatar'] ?>" alt="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>" class="profile-pic" style="cursor: pointer;" onmouseover="this.src='/img/icon/folder.png'" onmouseout="this.src='data:image/png;base64,<?= $_SESSION['avatar'] ?>'">
      </label>
      <input id='file-input' type='file' accept="image/*" onchange="changeAvatar(this)" hidden>
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
  function changeAvatar() {
    const file = document.getElementById('file-input').files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
      const xhr = new XMLHttpRequest();
      xhr.open('POST', '/script/setting.php', true);
      console.log(reader.result);
    };
    reader.onerror = function (error) {
      console.log('Error: ', error);
    };
    /*const img = document.getElementById('file-input').files[0];
    console.log(img);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/script/setting.php', true);
    xhr.send('img=' + window.btoa(unescape(encodeURIComponent( img.value ))))*/
  }
  function changeImgAvatar(image) {
    image.src = "../img/icon/folder.png";
    image.innerHtml = image;
  }
</script>

<?
 include '../footer.php';
?>
