document.addEventListener("DOMContentLoaded", () => {
    const settingsButton = document.getElementById("settingsButton");
    const modal = document.getElementById("settingsModal");
    const closeModal = document.getElementById("closeModal");

    settingsButton.addEventListener("click", () => {
        modal.style.display = "flex";
    });

    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const highContrastToggle = document.getElementById("highContrastToggle");
    const textSizeSelect = document.getElementById("textSize");
    const dyslexiaModeToggle = document.getElementById("dyslexiaModeToggle");
    const voiceReadToggle = document.getElementById("voiceReadToggle");
    const disableAnimationsToggle = document.getElementById("disableAnimationsToggle");
    const darkModeToggle = document.getElementById("darkModeToggle");



    // Changer la taille du texte
    textSizeSelect.addEventListener("change", () => {
        document.body.style.fontSize =
            textSizeSelect.value === "large" ? "18px" :
                textSizeSelect.value === "xlarge" ? "26px" : "16px";
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const iconSizeSelect = document.getElementById("iconSize");
    const navbar = document.querySelector(".navbar");

    // Fonction pour appliquer la taille des icônes
    function applyIconSize(size) {
        navbar.classList.remove("icon-normal", "icon-large", "icon-xlarge");
        navbar.classList.add(`icon-${size}`);
    }

    // Charger la taille des icônes depuis le stockage local
    const savedSize = localStorage.getItem("iconSize") || "normal";
    iconSizeSelect.value = savedSize;
    applyIconSize(savedSize);

    // Modifier la taille des icônes lorsqu'on change la sélection
    iconSizeSelect.addEventListener("change", () => {
        const newSize = iconSizeSelect.value;
        applyIconSize(newSize);
        localStorage.setItem("iconSize", newSize); // Sauvegarde dans le stockage local
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const iconSizeSelect = document.getElementById("iconSize");
    const dyslexiaToggle = document.getElementById("toggleDyslexia");
    const navbar = document.querySelector(".navbar");
    const body = document.body;

    // Fonction pour appliquer la taille des icônes
    function applyIconSize(size) {
        navbar.classList.remove("icon-normal", "icon-large", "icon-xlarge");
        navbar.classList.add(`icon-${size}`);
    }

    // Fonction pour activer/désactiver la dyslexie
    function applyDyslexiaMode(isEnabled) {
        if (isEnabled) {
            body.classList.add("dyslexia-mode");
        } else {
            body.classList.remove("dyslexia-mode");
        }
    }

    // Charger la taille des icônes depuis le stockage local
    const savedSize = localStorage.getItem("iconSize") || "normal";
    iconSizeSelect.value = savedSize;
    applyIconSize(savedSize);

    // Charger l'état du mode dyslexie
    const isDyslexiaEnabled = localStorage.getItem("dyslexiaMode") === "true";
    dyslexiaToggle.checked = isDyslexiaEnabled;
    applyDyslexiaMode(isDyslexiaEnabled);

    // Modifier la taille des icônes lorsqu'on change la sélection
    iconSizeSelect.addEventListener("change", () => {
        const newSize = iconSizeSelect.value;
        applyIconSize(newSize);
        localStorage.setItem("iconSize", newSize);
    });

    // Modifier le mode dyslexie lorsqu'on change le switch
    dyslexiaToggle.addEventListener("change", () => {
        const isChecked = dyslexiaToggle.checked;
        applyDyslexiaMode(isChecked);
        localStorage.setItem("dyslexiaMode", isChecked);
    });
});
