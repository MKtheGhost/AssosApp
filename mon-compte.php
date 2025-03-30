<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#1AB99F">
        <title>Mon compte</title>
        <link rel="shortcut icon" href="./images/logo.png">
        <link rel="stylesheet" type="text/css" href="./css/mon-compte.css">
        <link rel="apple-touch-icon" href="images/logo.png">
        <link rel="manifest" href="manifest.json">
        <script src="js/infosCompte.js" defer></script>

    </head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/mon-compte.css">
    <link rel="stylesheet" type="text/css" href="./css/settings.css">
    <script src="./js/settings.js" type="module"></script>
    <title>Mon Compte</title>
</head>
<body>
<header>
    <div id="loader" class="loader" style="display: none;"></div>
    <h1>Mon compte</h1>
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
    <form action="updateInfosCompte.php" method="post">
        <div class="infos-compte">
            <div class="double-div-container">
                <p><strong>Prénom:</strong> <input type="text" id="prenom" name="prenom" value=""> </p>

                <p><strong>Nom:</strong> <input type="text" id="nom" name="nom" value=""></p>
            </div>

            <div>
                <p><strong>Adresse:</strong> <input type="text" id="adresse-post" name="adresse-post" value=""></p>
            </div>

            <div class="double-div-container">
                <p><strong>Ville:</strong> <input type="text" id="ville" name="ville" value=""></p>

                <p><strong>Code <br> Postal:</strong> <input type="text" id="code-post" name="code-post" value=""></p>
            </div>

            <div>
                <p><strong>Mail:</strong> <input type="text" id="adresse-mail" name="adresse-mail" value=""></p>
            </div>

            <div>
                <p><strong>Mot de passe:</strong> <input type="password" id="mdp" name="mdp" placeholder="**********"></p>
            </div>
        </div>

        <h2>Paramètres supplémentaires</h2>

        <div class="checkbox-actu-container">
            <input type="checkbox" name="newsletter" id="newsletter">
            <label for="newsletter">Je souhaite recevoir des mails sur les actualités de l’application</label>
        </div>

        <div class="devise-container">
            <label for="currency">Devise de mes dons</label>
            <select name="devise" id="currency">
                <option value="€">€</option>
                <option value="$">$</option>
                <option value="£">£</option>
            </select>
        </div>

        <button type="submit">Modifier</button>
    </form>
    <form action="destroySession.php" method="post">
        <button type="submit" class="logout-btn" onclick="location.href='index.php'">Logout</button>
    </form>
</body>
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
</html>