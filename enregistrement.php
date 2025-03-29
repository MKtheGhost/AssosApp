<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once './DBConnect/db_connect.php';

    $prenom = $_POST['firstName'] ?? '';
    $nom = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['password'] ?? '';
    $confirm = $_POST['confirmPassword'] ?? '';
    $adresse = $_POST['address'] ?? '';
    $ville = $_POST['city'] ?? '';
    $cp = $_POST['zipCode'] ?? '';
    $grade = 'utilisateur';

    if ($prenom && $nom && $email && $mdp && $confirm && $mdp === $confirm) {
        try {
            $password = password_hash($mdp, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users 
            (user_firstname, user_name, user_mail, user_password, user_address, user_city, user_zipcode, user_grade)
            VALUES (:prenom, :nom, :email, :password, :adresse, :ville, :codePostal, :grade)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':codePostal', $cp);
            $stmt->bindParam(':grade', $grade);
            $stmt->execute();

            // Redirige avec un paramètre dans l'URL
            header("Location: connexion.html?register=1");
            exit;
        } catch (PDOException $e) {
            $message = "❌ Erreur lors de l'inscription : " . $e->getMessage();
        }
    } else {
        $message = "⚠️ Merci de remplir tous les champs obligatoires.";
    }
}
?>


<?php if (!empty($message)) : ?>
    <div style="color: red;"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
