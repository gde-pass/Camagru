function comment(element) {
  if (!element.id)
    return ;
  const req = element.id.split('/');
  if(req.length != 3)
    return ;
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


function comment_popup(element) {

}

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
  xhr.open("GET", "/script/script_getcomment.php?cube=" + cube, false);
  xhr.send(null);
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
