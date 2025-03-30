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
    <title>assos search</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" type="text/css" href="./css/rechercher.css">
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="manifest" href="manifest.json">
    <script type="module" src="js/recherche.js" defer></script>
    <link rel="stylesheet" type="text/css" href="./css/settings.css">
    <script src="./js/recherche.js" type="module"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/settings.js" type="module"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>


</head>
<body>
    <div class="container">
      <header><h1>Rechercher une association</h1>
        <div id="loader" class="loader" style="display: none;"></div>
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
        <div class="search-container">
          <form id="searchForm">
           
            <div class="search-input">
              <input type="text" placeholder="Rechercher par nom" id="searchInput" class="search-i">
            </div>

            <label for="selectHandi">Affiner par handicap</label>
            <div class="refine-search-container">
                <select id="selectHandi">
                    <!-- Options injected by JS -->
                  </select>
                  <input type="submit" value="Chercher" class="search-button">
            </div>
          </form>
        </div>
  
        <div id="assos-container">
          <!-- Assos injected by JS -->
        </div>
      </main>

        <footer>
            <nav class="navbar icon-normal">
                <a href="accueil.php"><img src="./images/svg/accueil.svg" alt="Accueil"></a>
                <a href="scanner.php"><img src="images/svg/scanner.svg" alt="Don"></a>
                <a href="recherche.php"><img src="images/svg/rechercher.svg" alt="Recherche"></a>
                <?php
                  if ($_SESSION['user_grade'] == "utilisateur") {
                    echo '<a href="don-souscription.php"><img src="images/svg/donation.svg" alt="Don"></a>';
                  } else if ($_SESSION['user_grade'] == "administrateur") {
                    echo '<a href="statistics.php"><img src="images/svg/donation.svg" alt="Don"></a>';
                  }

                ?>
                <?php
                  if ($_SESSION['user_grade'] == "utilisateur" || $_SESSION["user_grade"] == "administrateur") {
                    echo '<a href="mon-compte.php"><img src="images/svg/moncompte.svg" alt="Paramètres"></a>';
                  } else  {
                    echo '<a href="account-guest.php"><img src="images/svg/donation.svg" alt="Don"></a>';
                  }

                ?>            
            </nav>
        </footer>
    </div>
  </body>
</html>