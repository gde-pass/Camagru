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
        <video autoplay="true" id="video-camera" onChange="cameraChanged()" onclick="saveImg()" style="margin-left: 10px"></video>
        <div class="container-images">
          <canvas id="canvas0" onclick="selected(0, this)" class="camagru-canvas"></canvas>
          <canvas id="canvas1" onclick="selected(1, this)" class="camagru-canvas"></canvas>
          <canvas id="canvas2" onclick="selected(2, this)" class="camagru-canvas"></canvas>
        </div>

  <script>

  var nb = 0;
  var selection = 0;
  const video = document.getElementById("video-camera");
  var canvas = document.getElementById("canvas" + nb);
  const context = canvas.getContext('2d');
  var w = 640;
  var h = 480;

  if ( navigator.mediaDevices.getUserMedia) {
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

  function selected(i, element) {
    let tmp = 0;
    selection = i;
    element.style = "border-style:dotted";
    while (tmp <= nb) {
      if (tmp != i)
        element.style = "";
      tmp++;
    }
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
      nb++;
      canvas = document.getElementById("canvas" + nb);
    }
  }

  </script>

<?php
include '../footer.php';
?>
