let timer = document.querySelector(".what-time");
setInterval(function () {
    let sec = new Date().getSeconds()
    let min = new Date().getMinutes()
    let hour = new Date().getHours()
    timer.innerText = hour + "h : " + min + "min : " + sec + "S";
}, 1000);
