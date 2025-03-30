<?php
include_once './DBConnect/db_connect.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        try {
            $sql = "SELECT user_id, user_password, user_grade FROM users WHERE user_mail = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['user_password'])) {

                echo "<script>
                    localStorage.setItem('user_id', '" . addslashes($user['user_id']) . "');
                    localStorage.setItem('user_grade', '" . addslashes($user['user_grade']) . "');
                    window.location.href = 'accueil.php'; // Ensure the redirect happens after setting localStorage
                </script>";
                exit;
            } else {
                $message = "❌ Email ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $message = "❌ Erreur lors de la connexion : " . $e->getMessage();
        }
    } else {
        $message = "⚠️ Merci de remplir tous les champs obligatoires.";
    }
}

// S'il y a une erreur, on stocke le message dans sessionStorage via JS et on redirige vers connexion.html
echo "<script>
    sessionStorage.setItem('loginError', '" . addslashes($message) . "');
    window.location.href = 'connexion.html';
</script>";
exit;
?>
