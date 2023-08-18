function updateProgress(selector, endValue) {
    let circularProgress = document.querySelector('.circular-progress' + selector),
        progressValue = document.querySelector('.progress-value' + selector);

    let progressStartValue = 0,
        speed = 5;

    let progress = setInterval(() => {
        progressStartValue += 1;

        let displayedProgress = (progressStartValue / 10).toFixed(1);
        progressValue.textContent = `${displayedProgress}%`;
        circularProgress.style.background = `conic-gradient(#006401 ${displayedProgress * 3.6}deg, #7c7272 0deg)`;

        if (progressStartValue === endValue) {
            clearInterval(progress);
        }
    }, speed);
}

let progressEndValue24 = Math.floor(percentage24 * 10);
updateProgress('-24h', progressEndValue24);

let progressEndValue7 = Math.floor(percentage7 * 10);
updateProgress('-7d', progressEndValue7);
