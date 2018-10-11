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
        <form class="container-filtres">
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
        </form>
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
    console.log(selection);
    document.getElementById("filtre" + f[i]).checked = true;
  }

  function applyFiltre(element) {
    console.log(element.value);
    if (nb === 0)
      return ;
    f[selection] = element.value;
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
    console.log(res);
  }


  if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({video: true, audio: false})
    .then(function(stream) {
      video.srcObject = stream;
      console.log(video.offsetWidth);
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
      nb++;
      canvas = document.getElementById("canvas" + nb);
    }
  }

  </script>

<?php
include '../footer.php';
?>
