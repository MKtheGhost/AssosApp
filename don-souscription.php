<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <title>Dons et souscription</title>
    <link rel="stylesheet" href="./css/don-souscription.css" />
    <link rel="stylesheet" href="./css/settings.css" />
    <script src="./js/settings.js" type="module"></script>
    <meta name="theme-color" content="#1AB99F">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="manifest" href="manifest.json">
    <script src="./js/don-souscription.js" type="module"></script>


</head>
  <body>
    <div class="container">
      <header><h1>Dons et souscription</h1>
      <div id="loader" class="loader" style="display: none;"></div>
      <div class="settings-icon" id="settingsButton">
        <img src="./images/svg/settings-svgrepo-com.svg" alt="Paramètres" class="settings-icon">
      </div>
      </header>

      <main>
        <!-- Mes dons -->
        <h2>Mes derniers dons</h2>
        <div class="card-list" id="don-unique">
          <!-- Example of multiple donation cards -->

        <!---------- Refactor into JS with real data ----------->

        </div>

        <!-- Mes souscriptions -->
        <h2>Mes souscriptions</h2>
        <div class="card-list" id="don-rec">
          <!-- filled with JS -->
        </div>
      </main>

      <!-- Footer / Bottom Navigation -->
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
  </body>

  <!-- Popup de edit don reccurents -->
<div id="editDonModal" class="modal">
    <div class="modal-content">

        <h2>Modifiez vos dons</h2>

        <!-- montant don -->
        <label for="montant_don">Montant :</label>
        <input type="text" name="montant_don">

        <!-- Reccurence -->
        <label for="recurrence_don">Reccurence :</label>
        <select id="recurrence_don_select" name="recurrence_interval">
            <option value="1">Tous les mois</option>
            <option value="2">Tous les 3 mois</option>
            <option value="3">Tous les ans</option>
        </select>

        <label>
            <button class="close" id="closeeditModal">Enregistrer</button>
        </label>
    </div>

</div>
</html>
