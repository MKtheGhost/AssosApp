<?php
session_start();
$_SESSION = []; 
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
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_grade'] = $user['user_grade'];
                header("Location: accueil.php");
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
