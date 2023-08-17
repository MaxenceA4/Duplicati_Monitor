let circularProgress = document.querySelector('.circular-progress'),
    progressValue = document.querySelector('.progress-value');

let progressStartValue = 0,
    progressEndValue = Math.floor(percentage24 * 10), // Multipliez par 10 pour travailler avec des dixièmes de pourcent
    speed = 5; // Réduisez le temps d'attente entre chaque mise à jour

let progress = setInterval(() => {
    progressStartValue += 1; // Incrémente de 0.1%

    let displayedProgress = (progressStartValue / 10).toFixed(1); // Convertit le dixième de pourcent en pourcent et arrondit à 1 décimale
    progressValue.textContent = `${displayedProgress}%`;
    circularProgress.style.background = `conic-gradient(#006401 ${displayedProgress * 3.6}deg, #7c7272 0deg)`;

    if (progressStartValue === progressEndValue) {
        clearInterval(progress);
    }
}, speed);
