<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#1AB99F">
    <title>Statistiques des Dons</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="./css/statistics.css">
    <link rel="stylesheet" href="./css/settings.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/statistics.js" type="module"></script>
    <script src="./js/settings.js" type="module"></script>
</head>
<body>
<div class="container">
    <header class="main-header">
        <h1>Statistiques de Dons</h1>
        <div class="settings-icon" id="settingsButton" role="button" tabindex="0" aria-label="Paramètres">
            <img src="./images/svg/settings-svgrepo-com.svg" alt="" class="settings-icon">
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

    <!-- Section Top 3 Associations -->
    <section class="top-associations-section">
        <h2>Top 3 Associations</h2>
        <div class="associations-grid" id="topAssociationsList">
            <!-- Les cartes des associations seront insérées ici par JS -->
        </div>
    </section>

    <!-- Section Détails Association -->
<section class="association-details-section">
    <h2>Détails par Association</h2>
    <div class="association-selector">
        <input list="associations-list" id="associationInput" placeholder="Rechercher ou sélectionner une association...">
        <datalist id="associations-list">
            <!-- Les options seront insérées ici par JS -->
        </datalist>
        <!-- Champ caché pour conserver l'ID -->
        <input type="hidden" id="associationId">
    </div>
    <article class="association-details-card" id="associationDetails">
        <p>Sélectionnez une association pour voir les détails.</p>
    </article>
</section>  

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