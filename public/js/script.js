let timer = document.querySelector(".what-time");
setInterval(function () {
    let sec = new Date().getSeconds()
    let min = new Date().getMinutes()
    let hour = new Date().getHours()
    timer.innerText = "Time : " + hour + "h: " + min + " min:" + sec + " Sec";
}, 1000);
