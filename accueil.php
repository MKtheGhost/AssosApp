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
    <title>Solidarité Ensemble</title>
    <link rel="stylesheet" href="./css/home.css" />
    <link rel="stylesheet" type="text/css" href="./css/settings.css">
    <script src="./js/settings.js" type="module"></script>
    <script src="./js/accueil.js" type="module"></script>
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="manifest" href="manifest.json">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
<div class="container">
    <header>
        <h1>HandiDon</h1>
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
        <section class="hero">
            <div class="hero-content">
                <h2>Votre aide change des vies</h2>
                <p>Chaque don, même modeste, contribue à créer un monde meilleur. Ensemble, faisons la différence.</p>
                <a href="scanner.php" class="cta-button">J'ai un QR Code</a>
                <a href="recherche.php" class="cta-button">Rechercher une association</a>
            </div>
        </section>

        <section class="impact-section">
            <h2>L'impact de votre générosité</h2>
            <div class="impact-stats">
                <div class="stat-item">
                    <span class="stat-number" id="totalDonations">0</span>
                    <span class="stat-label">€ collectés</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="totalAssociations">0</span>
                    <span class="stat-label">associations soutenues</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="totalRecurrent">0</span>
                    <span class="stat-label">€ dons récurrents</span>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <h2>Votre geste compte</h2>
            <p>Même 5€ peuvent faire la différence. Chaque contribution nous aide à aller plus loin.</p>
            <div class="cta-buttons">
                <a href="recherche.php" class="cta-button secondary">Découvrir les associations</a>
            </div>
        </section>
    </main>

    <script>
      console.log(localStorage.getItem("user_grade"));
      </script>

    <footer>
        <nav class="navbar">
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
</div>
</body>
</html>
-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="theme-color" content="#1AB99F">
    <title>HandiDon</title>
    <link rel="stylesheet" href="./css/home.css" />
    <link rel="stylesheet" type="text/css" href="./css/settings.css">
    <script src="./js/settings.js" type="module"></script>
    <script src="./js/accueil.js" type="module"></script>
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="manifest" href="manifest.json">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
<div class="container" role="main">
    <header role="banner">
        <h1 id="page-title" tabindex="0">HandiDon</h1>
        <div class="settings-icon" id="settingsButton" tabindex="0" aria-label="Ouvrir les paramètres">
            <img src="./images/svg/settings-svgrepo-com.svg" alt="Icône de paramètres" class="settings-icon">
        </div>
    </header>

    <!-- Popup de paramètres -->
    <div id="settingsModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="modal-content">
            <h2 id="modalTitle">Paramètres d'Accessibilité</h2>
            <label for="textSize">Taille du texte :</label>
            <select id="textSize" aria-label="Choisir la taille du texte">
                <option value="normal">Normal</option>
                <option value="large">Grand</option>
                <option value="xlarge">Très grand</option>
            </select>
            <label>
                <input type="checkbox" id="toggleDyslexia" aria-label="Activer la police pour dyslexie"> Police pour dyslexie
            </label>
            <label for="iconSize">Taille des icônes :</label>
            <select id="iconSize" aria-label="Choisir la taille des icônes">
                <option value="normal">Normal</option>
                <option value="large">Grand</option>
                <option value="xlarge">Très grand</option>
            </select>
            <label>
                <button class="close" id="closeModal" aria-label="Enregistrer et fermer les paramètres">Enregistrer</button>
            </label>
        </div>
    </div>

    <main>
        <!-- Hero Section -->
        <section class="hero" role="region" aria-labelledby="heroTitle">
            <div class="hero-content">
                <h2 id="heroTitle" tabindex="0">Votre aide change des vies</h2>
                <p tabindex="0">Chaque don, même modeste, contribue à créer un monde meilleur. Ensemble, faisons la différence.</p>
                <a href="scanner.php" class="cta-button" aria-label="J'ai un QR Code">J'ai un QR Code</a>
                <a href="recherche.php" class="cta-button" aria-label="Rechercher une association">Rechercher une association</a>
            </div>
        </section>

        <!-- Impact Section -->
        <section class="impact-section" role="region" aria-labelledby="impactTitle">
            <h2 id="impactTitle" tabindex="0">L'impact de votre générosité</h2>
            <div class="impact-stats">
                <div class="stat-item">
                    <span class="stat-number" id="totalDonations" tabindex="0">0</span>
                    <span class="stat-label">€ collectés</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="totalAssociations" tabindex="0">0</span>
                    <span class="stat-label">associations soutenues</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="totalRecurrent" tabindex="0">0</span>
                    <span class="stat-label">€ dons récurrents</span>
                </div>
            </div>
        </section>
        <!-- Call to Action -->
        <section class="cta-section" role="region" aria-labelledby="ctaTitle">
            <h2 id="ctaTitle" tabindex="0">Votre geste compte</h2>
            <p tabindex="0">Même 5€ peuvent faire la différence. Chaque contribution nous aide à aller plus loin.</p>
            <div class="cta-buttons">
                <a href="recherche.php" class="cta-button secondary" aria-label="Découvrir les associations">Découvrir les associations</a>
            </div>
        </section>
    </main>

    <script>
      console.log(localStorage.getItem("user_grade"));
    </script>

    <footer role="contentinfo">
        <nav class="navbar" role="navigation" aria-label="Navigation principale">
            <a href="accueil.php" aria-label="Accueil"><img src="./images/svg/accueil.svg" alt="Accueil"></a>
            <a href="scanner.php" aria-label="Scanner ou faire un don"><img src="images/svg/scanner.svg" alt="Don"></a>
            <a href="recherche.php" aria-label="Recherche"><img src="images/svg/rechercher.svg" alt="Recherche"></a>
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
</div>
<!-- Div pour afficher les messages, rôle alert pour que les lecteurs d'écran l'annoncent -->
<div id="message" role="alert" aria-live="assertive"></div>
</body>
</html>
