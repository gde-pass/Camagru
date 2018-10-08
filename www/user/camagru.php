<?php
session_start();

include '../header.php';
?>

      <div class='form-title-row'>
          <h1>New Picture</h1>
          <div class="div-camera">
            <video autoplay="true" id="video-camera" onclick="saveImg()"></video>
            <div id="ifCamera">
            </div>
          </div>
      </div>

  <script>


  const video = document.getElementById("video-camera");
  const canvas = document.getElementById('canvas')
  const render = document.getElementById("render");
  const photo = document.getElementById('photo');
  const button = document.getElementById('save');
  const ifCamera = document.getElementById('ifCamera');
  const width = 1920;
  const height = 0;

  if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({video: true, audio: false})
    .then(function(stream) {
      video.srcObject = stream;
      ifCamera.innerHtml = "<button id='save'>Click</button><canvas id='canvas'></canvas>"
    })
    .catch(function(err) {
      console.log("Error : " + err);
    });
  }
  else {
    var vendorURL = window.URL || window.webkitURL;
    video.srcObject = vendorURL.createObjectURL(stream);
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
