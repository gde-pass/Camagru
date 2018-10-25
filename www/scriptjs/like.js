function like(element) {
  if (!element.id)
    return console.log("n o id");
  const req = element.id.split('/');
  if(req.length < 3)
    return ;
  const xhr = new XMLHttpRequest();
  if (req[req.length - 2] === 'data')
    return ;
  xhr.open("POST", '/script/script_like.php', false);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("nickname=" + req[req.length - 2] + "&img=" + req[req.length - 1]);
  if (xhr.status === 200) {
    console.log('OK - ' + xhr.responseText.toString());
    location.reload();
  }
  else {
    console.log('Error - ' + xhr.status + ' -> ' + xhr.statusText + '->' + xhr.responseText.toString());
  }
}
