<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1AB99F">
    <title>Scanner</title>
    <link rel="shortcut icon" href="./images/logo.png">

    <link rel="apple-touch-icon" href="images/logo.png">

    <link rel="stylesheet" type="text/css" href="./css/settings.css">
    <link rel="stylesheet" type="text/css" href="./css/scanner.css">

    <script src="./js/settings.js" type="module"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <script src="./js/scanner.js" type="module"></script>
<body>
<div class="container">

    <header>
        <h1>Scanner QR Code</h1>
        <div class="settings-icon" id="settingsButton">
            <img src="./images/svg/settings-svgrepo-com.svg" alt="Paramètres" class="settings-icon">
        </div>
    </header>

    <!-- Popup de paramètres -->
    <div id="settingsModal" class="modal">
        <div class="modal-content">

            <h2>Paramètres d'Accessibilité</h2>

            <!-- Taille du texte -->
            <label for="textSize">Taille du texte :</label>
            <select id="textSize">
                <option value="normal">Normal</option>
                <option value="large">Grand</option>
                <option value="xlarge">Très grand</option>
            </select>

            <!-- Mode Dyslexie -->
            <label>
                <input type="checkbox" id="toggleDyslexia"> Police pour dyslexie
            </label>

            <!-- Taille des icônes -->
            <label for="iconSize">Taille des icônes :</label>
            <select id="iconSize">
                <option value="normal">Normal</option>
                <option value="large">Grand</option>
                <option value="xlarge">Très grand</option>
            </select>
            <label>
                <button class="close" id="closeModal">Enregistrer</button>
            </label>
        </div>

    </div>


    <main>
        <div class="scan-instructions">
            <p id="result">test</p>
        <p class="info-text">Chaque scan soutient directement l'association de votre choix.</p>
        <!-- Zone vidéo pour afficher l'aperçu de la caméra -->
        <video id="preview" width="100%" height="auto" style="border: 1px solid #000;"></video>

        <!-- Instructions de scan -->

            <div class="instruction-steps">
                <div class="step">
                    <img src="./images/svg/scanner.svg" alt="Étape 1">
                    <p>Scannez le QR code de l'association</p>
                </div>
                <div class="step">
                    <img src="./images/svg/redirect-icon.svg" alt="Étape 2">
                    <p>Soyez redirigé automatiquement</p>
                </div>
                <div class="step">
                    <img src="./images/svg/donate-icon.svg" alt="Étape 3">
                    <p>Faites votre don en quelques clics</p>
                </div>
            </div>

        </div>


</main>

<footer>
    <nav class="navbar icon-normal">
        <a href="accueil.php"><img src="./images/svg/accueil.svg" alt="Accueil"></a>
        <a href="scanner.php"><img src="images/svg/scanner.svg" alt="Don"></a>
        <a href="recherche.php"><img src="images/svg/rechercher.svg" alt="Recherche"></a>
        <script>
            // Check if user_grade is stored in localStorage
            const userGrade = localStorage.getItem('user_grade');

            // Show the donation link based on the user grade
            if (userGrade === "utilisateur") {
                document.write('<a href="don-souscription.php"><img src="images/svg/donation.svg" alt="Don"></a>');
            } else if (userGrade === "administrateur") {
                document.write('<a href="statistics.php"><img src="images/svg/donation.svg" alt="Don"></a>');
            }

            // Show account link based on user grade
            if (userGrade === "utilisateur" || userGrade === "administrateur") {
                document.write('<a href="mon-compte.php"><img src="images/svg/moncompte.svg" alt="Paramètres"></a>');
            } else {
                document.write('<a href="account-guest.php"><img src="images/svg/donation.svg" alt="Don"></a>');
            }
        </script>
    </nav>
</footer>

</div>

</body>
</html>
