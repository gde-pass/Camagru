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
          <input type="radio" name="filtres" id="filtre5" value="5" onclick="applyFiltre(this)" hidden>
          <label for="filtre5">
            <img src="/img/filtre/filtre_afeuerst.png" alt="" title="">
          </label>
        </div>
        <textarea maxlength="80" id="comment"></textarea>
        <button class="button" onClick="send()">Send</button>
  <script>

  var nb = 0;
  let selection = 0;
  const video = document.getElementById("video-camera");
  var canvas = document.getElementById("canvas" + nb);
  const context = canvas.getContext('2d');
  const f = ["0", "0", "0"];
  var w = 640;
  var h = 480;
  const filtreMax = 5;


  function selected(i, element) {
    if (i < nb)
      selection = i;
    else
      return ;
    document.getElementById("filtre" + f[i]).checked = true;
  }

  function applyFiltre(element) {
    if (nb === 0)
      return ;
    f[selection] = element.value;
  }

  function send() {
    let i = 0;
    let res = "";
    if (nb === 0 || nb > 3){
      alert("Please take picture before send");
      return ;
    }
    while(i < nb) {
      if (i > 0)
        res += '#';
      const canvatmp = document.getElementById("canvas" + i);
      if (!canvatmp) {
        alert("An error Occured");
        return ;
      }
      res +=  canvatmp.toDataURL('image/png', 1) + "," + f[i];
      i++;
    }
    const comment = '&comment=' + document.getElementById('comment').value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/script/script_merge_image.php', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('req=' + res + comment);
    if (xhr.status === 200) {
      window.location.href = "/";
    }
    else {
      console.log('Error - ' + xhr.status + ' -> ' + xhr.statusText + '->' + xhr.responseText.toString());
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
      nb++;
      canvas = document.getElementById("canvas" + nb);
    }
  }

  </script>

<?php
include '../footer.php';
?>
