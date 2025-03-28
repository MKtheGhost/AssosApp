<?php
session_start();
include_once './DBConnect/db_connect.php'; // adapte le chemin si besoin

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        try {
            $sql = "SELECT user_id, user_password FROM users WHERE user_mail = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['user_password'])) {
                // Mot de passe valide, démarrage de la session
                $_SESSION['user_id'] = $user['user_id'];

                echo "<script>
                    alert('✅ Connexion réussie !');
                    window.location.href = 'recherche.html';
                </script>";
                exit;
            } else {
                // Erreur de connexion
                echo "<script>
                    alert('❌ Email ou mot de passe incorrect.');
                    window.history.back();
                </script>";
                exit;
            }
        } catch (PDOException $e) {
            echo "<script>
                alert('Erreur serveur : " . addslashes($e->getMessage()) . "');
                window.history.back();
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('⚠️ Veuillez remplir tous les champs.');
            window.history.back();
        </script>";
        exit;
    }
}
?>
