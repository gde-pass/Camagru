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
