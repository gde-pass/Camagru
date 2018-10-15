<?php
session_start();

if ($_SESSION['logged'] != true) {
  header('Location: /form/form_login.php?logged=no');
  exit(0);
}

include '../header.php';
?>

      <div class='form-title-row'>
        <h1>New Picture</h1>
      </div>
        <video autoplay="true" id="video-camera" onChange="cameraChanged()" onclick="saveImg()"></video>
        <div class="container-images">
          <input type="radio" id="canva0" name="canva" hidden>
            <label for="canva0">
              <canvas id="canvas0" onclick="selected(0, this)" class="camagru-canvas" style="visibility:hidden"></canvas>
            </label>
          <input type="radio" id="canva1" name="canva" hidden>
            <label for="canva1">
              <canvas id="canvas1" onclick="selected(1, this)" class="camagru-canvas" style="visibility:hidden"></canvas>
            </label>
          <input type="radio" id="canva2" name="canva" hidden>
            <label for="canva2">
              <canvas id="canvas2" onclick="selected(2, this)" class="camagru-canvas" style="visibility:hidden"></canvas>
            </label>
        </div>
        <div id="filtres-hidden" name="filtre-hidden">0,0,0</div>
        <div class="container-filtres">
          <input type="radio" name="filtres" id="filtre0" value="0" onclick="applyFiltre(this)" hidden>
          <label for="filtre0">
            <img src="/img/filtre/empty.png" alt="" title="">
          </label>
          <input type="radio" name="filtres" id="filtre1" value="1" onclick="applyFiltre(this)" hidden>
          <label for="filtre1">
            <img src="/img/filtre/star.png" alt="" title="">
          </label>
          <input type="radio" name="filtres" id="filtre2" value="2" onclick="applyFiltre(this)" hidden>
          <label for="filtre2">
            <img src="/img/filtre/circular.png" alt="" title="">
          </label>
          <input type="radio" name="filtres" id="filtre3" value="3" onclick="applyFiltre(this)" hidden>
          <label for="filtre3">
            <img src="/img/filtre/smoke.png" alt="" title="">
          </label>
          <input type="radio" name="filtres" id="filtre4" value="4" onclick="applyFiltre(this)" hidden>
          <label for="filtre4">
            <img src="/img/filtre/flower.png" alt="" title="">
          </label>
        </div>
        <textarea name="comment"></textarea>
        <button onClick="send()">Send</button>
  <script>

  var nb = 0;
  let selection = 0;
  const video = document.getElementById("video-camera");
  var canvas = document.getElementById("canvas" + nb);
  const context = canvas.getContext('2d');
  const f = ["0", "0", "0"];
  var w = 640;
  var h = 480;
  const filtreMax = 4;


  function selected(i, element) {
    if (i < nb)
      selection = i;
    else
      return ;
    document.getElementById("filtre" + f[i]).checked = true;
    document.getElementById("filtres-hidden").innerHTML = f.toString();
  }

  function applyFiltre(element) {
    console.log(element.value);
    if (nb === 0)
      return ;
    f[selection] = element.value;
    document.getElementById("filtres-hidden").innerHTML = f.toString();
  }

  function send() {
    let i = 0;
    let res = "<?= $_SESSION['nickname']?>\n";
    if (nb === 0){
      alert("An error Occured");
      return ;
    }
    while(i < nb) {
      const canvatmp = document.getElementById("canvas" + i);
      if (!canvatmp) {
        alert("An error Occured");
        return ;
      }
      res +=  canvatmp.toDataURL('image/png', 1) + "," + f[i] + '\n';
      i++;
    }
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/script/script_merge_image.php', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('?req=' + res);
    if (xhr.status === 200) {
      console.log('OK - ' + xhr.responseText.toString());
    }
    else {
      console.log('Error - ' + xhr.status + ' -> ' + xhr.statusText);
    }
  }


  if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({video: true, audio: false})
    .then(function(stream) {
      video.srcObject = stream;
    })
    .catch(function(err) {
      console.log("Error : " + err);
      window.location.replace('/user/mygallery.php');
    });
  }

  else {
    var vendorURL = window.URL || window.webkitURL;
  }

  function saveImg() {
    if (nb > 2) {
      alert("maximum image");
    }
    else {
      canvas.width = w;
      canvas.height = h;
      var context = canvas.getContext('2d');
      context.fillRect(0, 0, w, h);
      context.drawImage(video, 0, 0, w, h);
      context.globalAlpha = 0.5;
      let img = document.getElementById("f1");
      context.drawImage = (img, 0, 0, w, h);
      canvas.style.visibility = "visible";
      document.getElementById("filtre" + f[nb]).checked = true;
      document.getElementById("canvas" + nb).checked = true;
      document.getElementById("filtres-hidden").innerHTML = f.toString();
      nb++;
      canvas = document.getElementById("canvas" + nb);
    }
  }

  </script>

<?php
include '../footer.php';
?>
