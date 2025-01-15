const videos = [
    { url: './img/Rasca.mp4', title: 'Dibujos animados', character: 'Rasca & Pica', tipo: 'Video' },
    { url: './img/Homer.mp4', title: 'Los Simpson', character: 'Homer', tipo: 'Video' },
    { url: './img/Lisa.mp4', title: 'Militares', character: 'Lisa', tipo: 'Video' },
    { url: './img/Skinner.mp3', title: 'Pensamientos', character: 'Skinner', tipo: 'Audio' },
    { url: './img/Grito.mp3', title: 'Conversación', character: 'Homer/Milhouse', tipo: 'Audio' },
    { url: './img/Ralph.mp3', title: 'Carreras', character: 'Ralph', tipo: 'Audio' }
];

let currentVideoIndex = 0;
const video = document.getElementById('mainVideo');
const screen = document.querySelector('.screen');
const channelInfo = document.getElementById('channelInfo');
const characterInfo = document.getElementById('characterInfo');
const typeInfo = document.getElementById('typeInfo');

// Función para cambiar el video
function changeVideo(direction) {
    console.log("Ahora: " + currentVideoIndex);
    screen.classList.add('changing-channel');
    setTimeout(() => {
        if (direction === 'next') {
            currentVideoIndex = (currentVideoIndex + 1) % videos.length; // Ciclo circular hacia adelante
        } else {
            currentVideoIndex = currentVideoIndex === 0 ? videos.length - 1 : currentVideoIndex - 1; // Ciclo circular hacia atrás
        }

            
        if (currentVideoIndex == 3) {
            screen.style.backgroundImage = `url('./img/Skinner.jpg')`; // Establecer imagen de fondo
            screen.style.backgroundSize = 'cover';
            screen.style.backgroundRepeat = 'no-repeat';
        } else if (currentVideoIndex == 4) {
            screen.style.backgroundImage = `url('./img/Homer.webp')`;
            screen.style.backgroundSize = 'cover';
            screen.style.backgroundRepeat = 'no-repeat';
        } else if (currentVideoIndex == 5) {
            screen.style.backgroundImage = `url('./img/Ralph.jpg')`;
            screen.style.backgroundSize = 'cover';
            screen.style.backgroundRepeat = 'no-repeat';
        }else {
            // Si es un archivo de video, limpiamos el fondo
            screen.style.backgroundImage = ''; // Limpiar fondo si es video
        }
        console.log("Después: " + currentVideoIndex);
        video.src = videos[currentVideoIndex].url;
        channelInfo.textContent = `Canal ${currentVideoIndex + 1}: ${videos[currentVideoIndex].title}`;
        characterInfo.textContent = `Personaje: ${videos[currentVideoIndex].character}`;
        typeInfo.textContent = `Tipo: ${videos[currentVideoIndex].tipo}`;
        
        setTimeout(() => {
            screen.classList.remove('changing-channel');
        }, 500);
    }, 300);
    document.getElementById('playBtn').textContent = '▶';
}



// Event Listeners para los controles
document.querySelector('.prev-btn').addEventListener('click', () => changeVideo('prev'));
document.querySelector('.next-btn').addEventListener('click', () => changeVideo('next'));

document.getElementById('muteBtn').addEventListener('click', () => {
    video.muted = !video.muted;
    document.getElementById('muteBtn').textContent = video.muted ? 'Unmute' : 'Silenciar';
});

document.getElementById('playBtn').addEventListener('click', () => {
    if (video.paused) {
        video.play();
        document.getElementById('playBtn').textContent = '⏸';
    } else {
        video.pause();
        document.getElementById('playBtn').textContent = '▶';
    }
});

document.getElementById('backBtn').addEventListener('click', () => {
    video.currentTime = Math.max(0, video.currentTime - 10);
});

document.getElementById('forwardBtn').addEventListener('click', () => {
    video.currentTime = Math.min(video.duration, video.currentTime + 10);
});

document.getElementById('resetBtn').addEventListener('click', () => {
    video.currentTime = 0;
});

document.getElementById('volUpBtn').addEventListener('click', () => {
    video.volume = Math.min(1, video.volume + 0.1);
});

document.getElementById('volDownBtn').addEventListener('click', () => {
    video.volume = Math.max(0, video.volume - 0.1);
});

// Efecto de estática al cambiar de canal
video.addEventListener('seeking', () => {
    screen.classList.add('changing-channel');
    setTimeout(() => {
        screen.classList.remove('changing-channel');
    }, 500);
});