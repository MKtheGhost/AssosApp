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
            <span class="close" id="closeModal"></span>
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



        </div>
    </div>


<main>

    <!-- Zone vidéo pour afficher l'aperçu de la caméra -->
    <video id="preview" width="100%" height="auto" style="border: 1px solid #000;"></video>
    
    <!-- Affichage du résultat du scan -->
    <div id="result" style="text-align: center; margin-top: 20px;"></div>


</main>

<footer>
    <nav class="navbar icon-normal">
        <a href="accueil.php"><img src="./images/svg/accueil.svg" alt="Accueil"></a>
        <a href="scanner.php"><img src="images/svg/scanner.svg" alt="Don"></a>
        <a href="recherche.php"><img src="images/svg/rechercher.svg" alt="Recherche"></a>
        <?php
            if ($_SESSION["user_grade"] == "utilisateur") {
                echo '<a href="don-souscription.php"><img src="images/svg/donation.svg" alt="Don"></a>';
            } else if ($_SESSION["user_grade"] == "administrateur") {
                echo '<a href="statistics.php"><img src="images/svg/donation.svg" alt="Don"></a>';
            }
        ?>
        <a href="mon-compte.php"><img src="images/svg/moncompte.svg" alt="Paramètres"></a>
    </nav>
</footer>

</div>

</body>
</html>
