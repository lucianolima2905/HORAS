function updateClock() {
    const clock = document.getElementById("clock");
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    clock.innerHTML = `<i class="fas fa-clock"></i> ${hours}:${minutes}:${seconds}`;
}

function updateCurrentTime() {
    const currentTimeElement = document.getElementById("current-time");
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    currentTimeElement.innerHTML = `<i class="fas fa-clock"></i> ${hours}:${minutes}:${seconds}`;
}

setInterval(updateClock, 1000);
setInterval(updateCurrentTime, 1000);

document.getElementById("generate").addEventListener("click", function () {
    generateSchedule();
});

document.getElementById("generateJogadas").addEventListener("click", function () {
    generateJogadas();
});

document.getElementById("copy").addEventListener("click", function () {
    copyToClipboard();
});

document.getElementById("clear").addEventListener("click", function () {
    clearSchedule();
});

document.getElementById("emojis").addEventListener("click", function () {
    toggleEmojiPicker();
});

const emojis = document.getElementById("emojis");
emojis.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        toggleEmojiPicker();
    }
});

emojis.addEventListener("blur", function () {
    emojis.classList.remove("show");
});

emojis.addEventListener("click", function (event) {
    if (event.target.tagName === "SPAN") {
        const message = document.getElementById("message");
        message.value += event.target.textContent;
        emojis.classList.remove("show");
        message.focus();
    }
});

// ...

function generateSchedule() {
    const intervalo = parseInt(document.getElementById("intervalo").value, 10);
    const horarios = document.getElementById("horarios");
    horarios.innerHTML = "";
    clearNotification();

    const now = new Date();
    const currentHour = now.getHours();
    const currentMinute = now.getMinutes();

    const message = document.getElementById("message").value;
    const typeSelector = document.getElementById("typeSelector");
    const selectedType = typeSelector.options[typeSelector.selectedIndex].value;
    const gameSelector = document.getElementById("gameSelector");
    const selectedGame = gameSelector.options[gameSelector.selectedIndex].value;
    const link = document.getElementById("link").value;
    const bookmakerSelector = document.getElementById("bookmakerSelector");
    const selectedBookmaker = bookmakerSelector.options[bookmakerSelector.selectedIndex].text;

    const messageAndPlatform = document.getElementById("messageAndPlatform");
    messageAndPlatform.innerHTML = `${selectedType} - ${selectedGame} ${message} na ${selectedBookmaker}`;

    for (let i = currentHour; i < currentHour + 2; i++) {
        for (let j = (i === currentHour ? currentMinute : 0); j < 60; j += intervalo) {
            if (i === currentHour && j < currentMinute) {
                continue;
            }
            const time = `${i.toString().padStart(2, '0')}:${j.toString().padStart(2, '0')}`;
            const clockEmoji = "⏰ ";
            const scheduleItem = document.createElement("p");
            scheduleItem.innerText = clockEmoji + time + clockEmoji;
            horarios.appendChild(scheduleItem);
        }
    }

    if (link) {
        messageAndPlatform.innerHTML += ` 💰 PLATAFORMA PAGANTE:\n📎 ${link} - ${selectedBookmaker}`;
    }
}

function generateJogadas() {
    const jogadasElement = document.getElementById("horarios");
    jogadasElement.innerHTML = "";

    // Adicionando 8 minutos à hora atual
    const now = new Date();
    now.setMinutes(now.getMinutes() + 8);

    const estrategia = "📊 Estratégia Vencedora:";
    const valores = [0.4, 0.8, 1.2];
    const link = document.getElementById("link").value;
    const bookmakerSelector = document.getElementById("bookmakerSelector");
    const selectedBookmaker = bookmakerSelector.options[bookmakerSelector.selectedIndex].text;
    const gameSelector = document.getElementById("gameSelector");
    const selectedGame = gameSelector.options[gameSelector.selectedIndex].value;

    const valor = valores[Math.floor(Math.random() * valores.length)];
    const quantidadeNormal = Math.floor(Math.random() * 11);
    const quantidadeTurbo = Math.floor(Math.random() * 11);

    const mensagemJogo = `🎮 JOGO PAGANTE:\n ${selectedGame}\n💰 PLATAFORMA PAGANTE:\n📎 ${link} - ${selectedBookmaker}`;
    const mensagemEstrategia = `${estrategia}\n${quantidadeNormal}x R$${valor.toFixed(2)} - normal 👈\n${quantidadeTurbo}x R$${valor.toFixed(2)} - turbo ⚡️`;

    const mensagemGeral = `${mensagemJogo}\n\n${mensagemEstrategia}\n⏱ Válido até as 👉 ${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}\n\n📲 Baixe nosso app\n📎 https://bet9k.fun/app/`;

    const jogadasItem = document.createElement("p");
    jogadasItem.innerText = mensagemGeral;
    jogadasElement.appendChild(jogadasItem);
}

// ...


function clearSchedule() {
    const horarios = document.getElementById("horarios");
    horarios.innerHTML = "";
}

function copyToClipboard() {
    const messageAndPlatform = document.getElementById("messageAndPlatform").innerText;
    const horarios = document.getElementById("horarios").innerText;
    const textArea = document.createElement("textarea");
    textArea.value = `${messageAndPlatform}\n${horarios}`;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("copy");
    document.body.removeChild(textArea);
    showNotification();
    clearSchedule(); // Reinicia o sistema ao copiar
}

function showNotification() {
    const notification = document.getElementById("copySuccess");
    notification.style.display = "block";
    setTimeout(() => {
        clearNotification();
    }, 2000);
}

function clearNotification() {
    const notification = document.getElementById("copySuccess");
    notification.style.display = "none";
}

updateClock();
updateCurrentTime();
