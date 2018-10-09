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
          <video autoplay="true" id="video-camera" onChange="cameraChanged()" onclick="saveImg()"></video>
          <canvas></canvas>
          <button id="snap">Capture</button>
      </div>

  <script>


  const video = document.getElementById("video-camera");
  const canvas = document.querySelector("canvas");
  const context = canvas.getContext('2d');
  var w = 0;
  var h = 0;

  if ( navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({video: true, audio: false})
    .then(function(stream) {
      video.srcObject = stream;
    })
    .catch(function(err) {
      console.log("Error : " + err);
    });
  }

  else {
    var vendorURL = window.URL || window.webkitURL;
  }

  function cameraChanged() {
    w = video.videoWidth - 100;
    console.log(w + ' - Width');
  }

  function saveImg() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  </script>

<?php
include '../footer.php';
?>
