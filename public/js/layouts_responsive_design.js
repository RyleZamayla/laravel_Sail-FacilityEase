setImageBasedOnMode();
// Function to check if the system is in dark mode
function isDarkMode() {
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
}

// Function to set the appropriate image based on dark mode
function setImageBasedOnMode() {
    const img = document.querySelector('.mode-switchable-image');
    if (img !== null) {
        if (isDarkMode()) {
            // Dark mode, set the dark image
            img.src = darkLogoUrl;
            img.classList.add('dark-image');
            img.classList.remove('light-image');
        } else {
            // Light mode, set the light image
            img.src = lightLogoUrl;
            img.classList.add('light-image');
            img.classList.remove('dark-image');
        }
    }

}

// Listen for changes in the system's color scheme
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    setImageBasedOnMode();
});

function updateCardStyle() {


}
