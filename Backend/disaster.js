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


 
// update the tag with id "countdown" every 1 second
function ticktock(){
    // 10 minutes from now
    var time_in_minutes = 10;
    var current_time = Date.parse(new Date());
    var deadline = new Date(current_time + time_in_minutes*60*1000);

    // variables for time units
    var minutes, seconds;

    var inter = setInterval(function() { 
        var countdown = document.getElementById("countdown");
        // find the amount of "seconds" between now and target
        var current_date = new Date().getTime();
        var seconds_left = (deadline - current_date) / 1000;
     
        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);
        countdown.innerHTML = '<span class="minutes">' + minutes + ' <b>Minutes</b></span> <span class="seconds">' + seconds + ' <b>Seconds</b></span>';  
        if(minutes == 0 && seconds == 0){
            console.log("clear");
            clearInterval(inter);
        }
    }, 1000);
}

window.onload = ticktock;
