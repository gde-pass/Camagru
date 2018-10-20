// Get the button that opens the modal
var btn = document.getElementsByTagName("comment");

let imgtocomment = null;
let user = null;

// When the user clicks on the button, open the modal
function display_modal(img) {
  const modal = document.getElementById("myodal");
  if (!img.id) {
    alert('An error occured');
    return ;
  }
  imgtocomment = img.id.split('/');
  if (imgtocomment.length < 2)
    return alert('An error occured');
  cube = imgtocomment[imgtocomment.length - 1];
  user = imgtocomment[imgtocomment.length - 2];
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/script/script_getcomment.php?cube=" + cube + "&user=" + user, false);
  xhr.send(null);
  if (xhr.status === 200) {

  }
  else if (xhr.status === 400){
    document.getElementById('previous_comments').innerHTML = "<h id='no_comments'>No comment has been posted</h>";
  }
  modal.style = "display: block";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  const modal = document.getElementById("myodal");
  imgtocomment = null;
    if (event.target == modal) {
        modal.style = "display: none";
    }
}


function comment(element) {
  console.log(element);
  if (imgtocomment === null) {
    const modal = document.getElementById("myodal");
    modal.style = "display: none";
  }
  const xhr = new XMLHttpRequest();
  xhr.open("POST", '/script/script_like.php', false);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("img=" + req[2] + "");
  if (xhr.status === 200) {
    console.log('OK - ' + xhr.responseText.toString());
  }
  else {
    console.log('Error - ' + xhr.status + ' -> ' + xhr.statusText + '->' + xhr.responseText.toString());
  }
}
