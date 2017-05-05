function loadDoc(fileUrl,id){
    const xhttp= new XMLHttpRequest();
    xhttp.open("GET",fileUrl,true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
        document.getElementById(id).innerHTML =this.responseText;
  };
}

function controlDoc(fileUrlSupport,fileUrl,id){
    const xhttp= new XMLHttpRequest();
    xhttp.open("GET",fileUrlSupport,true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200)
        loadDoc(fileUrl,id);
  };
}

function sendData(fileUrl){
  const xhttp= new XMLHttpRequest();
  xhttp.open("GET",fileUrl,true);
  xhttp.send();
}