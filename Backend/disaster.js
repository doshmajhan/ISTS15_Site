function loadDisaster(url) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 & xhttp.status == 200){
            var div = document.getElementById('disaster');
            if(xhttp.responseText.trim() === 'NULL'){
                div.innerHTML = "Couldn't connect, R.I.P";
            }
            else {
                div.innerHTML = xhttp.responseText.trim();
            }
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
