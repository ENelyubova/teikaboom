var video = document.getElementById("videoPlayer");
var btn = document.getElementById("playBtn");

btn.addEventListener('click', function () {
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
}, false);

video.addEventListener('play', function () {
    btn.classList.add('active');
}, false);
 
video.addEventListener('pause', function () {
    btn.classList.remove('active');
}, false);

function stop() {
    video.pause();
    video.currentTime = 0;
}

function progressUpdate() {
    // Устанавливаем позицию воспроизведения
    var positionBar = document.getElementById("positionBar");
    positionBar.style.width = (video.currentTime / video.duration * 100)  + "%";

    // Заполняем текстовую надпись текущим значением
    displayStatus = document.getElementById("displayStatus");
    displayStatus.innerHTML = (Math.round(video.currentTime*100)/100) + " сек";
}

//при завершении видео сброс в исходное состояние
video.addEventListener('ended',myHandler,false);

function myHandler(e) {
    this.load();
}