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
  <title>Association</title>
  <link rel="stylesheet" href="./css/association.css">
  <link rel="stylesheet" href="./css/settings.css">
  <script src="./js/association.js" type="module"></script>
    <script src="./js/settings.js" type="module"></script>
</head>
<body>
<div class="container">
  <header><h1>En savoir + sur l'association</h1>
    <div class="settings-icon" id="settingsButton">
      <img src="./images/svg/settings-svgrepo-com.svg" alt="Paramètres" class="settings-icon">
    </div>
  </header>
  <div id="loader" class="loader" style="display: none;"></div>
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
    <section class="top-circle">
      <div class="image-wrapper">
        <img id="asso-image" src="./images/assos/default-image.jpg" alt="Association Image"/>
      </div>
      <h2 id="asso-name">Chargement...</h2>
      <p id="asso-desc"></p>
      <a id="asso-site" href="#" target="_blank" style="display:none;">Site de l'association</a>
    </section>

    <section class="bottom-circle">
      <a href="paiement-don.html?id_assos=<?= $_GET['id'] ?>" id="donation-button">Je donne</a>
    </section>
      <section class="retour">
      <button id="recherche-button" onclick="location.href='./recherche.php'">Retourner à la recherche</button>
          </section>
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