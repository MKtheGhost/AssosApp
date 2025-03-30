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
    <title>Gestion de compte</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" type="text/css" href="./css/account-guest.css">
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="manifest" href="manifest.json">
                

</head>
<body class="container">
    <h1>Connectez-vous pour plus d'options</h1>
        
        <button onclick="location.href='./connexion.html'" class="connect">Se connecter</button>
        <br>
        <p> Vous n'avez pas de compte ?</p>
        <button onclick="location.href='./enregistrement.html'">Créer un compte</button>

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
</body>
</html>