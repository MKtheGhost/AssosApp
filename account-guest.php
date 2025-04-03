<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!--
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="theme-color" content="#1AB99F">
    <title>Gestion de compte</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" type="text/css" href="./css/account-guest.css">
    <link rel="stylesheet" type="text/css" href="./css/settings.css">
    <script src="./js/settings.js" type="module"></script>
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="manifest" href="manifest.json">
                

</head>
<body class="container">
<header>
    <h1>Connectez-vous pour plus d'options</h1>
    <div id="loader" class="loader" style="display: none;"></div>
    <div class="settings-icon" id="settingsButton">
        <img src="./images/svg/settings-svgrepo-com.svg" alt="Paramètres" class="settings-icon">
    </div>

</header>

<div id="settingsModal" class="modal">
    <div class="modal-content">

        <h2>Paramètres d'Accessibilité</h2>

        <label for="textSize">Taille du texte :</label>
        <select id="textSize">
            <option value="normal">Normal</option>
            <option value="large">Grand</option>
            <option value="xlarge">Très grand</option>
        </select>

        <label>
            <input type="checkbox" id="toggleDyslexia"> Police pour dyslexie
        </label>

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
        <button onclick="location.href='./connexion.html'" class="connect">Se connecter</button>
        <br>
        <p> Vous n'avez pas de compte ?</p>
        <button onclick="location.href='./enregistrement.html'">Créer un compte</button>
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
                    document.write('<a href="account-guest.php"><img src="images/svg/moncompte.svg" alt="Don"></a>');
                }
            </script>
            </nav>
        </footer>
</body>
</html>
            -->

            <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="theme-color" content="#1AB99F">
    <title>Gestion de compte</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" type="text/css" href="./css/account-guest.css">
    <link rel="stylesheet" type="text/css" href="./css/settings.css">
    <script src="./js/settings.js" type="module"></script>
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="manifest" href="manifest.json">
</head>
<body class="container">
  <header role="banner">
    <h1 id="page-title">Connectez-vous pour plus d'options</h1>
    <div id="loader" class="loader" style="display: none;" aria-hidden="true"></div>
    <div class="settings-icon" id="settingsButton" tabindex="0" aria-label="Ouvrir les paramètres">
        <img src="./images/svg/settings-svgrepo-com.svg" alt="Icône de paramètres" class="settings-icon">
    </div>
  </header>

  <!-- Popup de paramètres -->
  <div id="settingsModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="settingsTitle">
    <div class="modal-content">
        <h2 id="settingsTitle">Paramètres d'Accessibilité</h2>
        <!-- Taille du texte -->
        <label for="textSize">Taille du texte :</label>
        <select id="textSize">
            <option value="normal">Normal</option>
            <option value="large">Grand</option>
            <option value="xlarge">Très grand</option>
        </select>
        <!-- Mode Dyslexie -->
        <label>
            <input type="checkbox" id="toggleDyslexia" aria-label="Activer la police pour dyslexie"> Police pour dyslexie
        </label>
        <!-- Taille des icônes -->
        <label for="iconSize">Taille des icônes :</label>
        <select id="iconSize">
            <option value="normal">Normal</option>
            <option value="large">Grand</option>
            <option value="xlarge">Très grand</option>
        </select>
        <label>
            <button class="close" id="closeModal" aria-label="Fermer les paramètres">Enregistrer</button>
        </label>
    </div>
  </div>

  <main role="main">
    <button onclick="location.href='./connexion.html'" class="connect" aria-label="Se connecter">Se connecter</button>
    <br>
    <p tabindex="0">Vous n'avez pas de compte ?</p>
    <button onclick="location.href='./enregistrement.html'" aria-label="Créer un compte">Créer un compte</button>
  </main>

  <footer role="contentinfo">
    <nav class="navbar icon-normal" role="navigation" aria-label="Navigation principale">
        <a href="accueil.php"><img src="./images/svg/accueil.svg" alt="Accueil"></a>
        <a href="scanner.php"><img src="images/svg/scanner.svg" alt="Scanner (Don)"></a>
        <a href="recherche.php"><img src="images/svg/rechercher.svg" alt="Recherche"></a>
        <script>
            // Check if user_grade is stored in localStorage
            const userGrade = localStorage.getItem('user_grade');
            // Show the donation link based on the user grade
            if (userGrade === "utilisateur") {
                document.write('<a href="don-souscription.php" aria-label="Faire un don"><img src="images/svg/donation.svg" alt="Don"></a>');
            } else if (userGrade === "administrateur") {
                document.write('<a href="statistics.php" aria-label="Voir les statistiques"><img src="images/svg/donation.svg" alt="Don"></a>');
            }
            // Show account link based on user grade
            if (userGrade === "utilisateur" || userGrade === "administrateur") {
                document.write('<a href="mon-compte.php" aria-label="Gérer mon compte"><img src="images/svg/moncompte.svg" alt="Paramètres"></a>');
            } else {
                document.write('<a href="account-guest.php" aria-label="Compte invité"><img src="images/svg/moncompte.svg" alt="Don"></a>');
            }
        </script>
    </nav>
  </footer>
  
  <!-- Optionnel : Ajouter un script inline pour les messages d'erreur -->
  <script>
    window.addEventListener("DOMContentLoaded", () => {
      const params = new URLSearchParams(window.location.search);
      if (params.get('register') === '1') {
        alert("✅ Enregistrement réussi !");
        window.history.replaceState({}, document.title, window.location.pathname);
      }
      const error = sessionStorage.getItem('loginError');
      if (error) {
        document.getElementById('message').textContent = error;
        sessionStorage.removeItem('loginError');
      }
    });
  </script>
  
  <!-- Div pour afficher les messages -->
  <div id="message" role="alert" aria-live="assertive"></div>
  
</body>
</html>
