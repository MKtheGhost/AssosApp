<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once './DBConnect/db_connect.php'; // Adapte le chemin si besoin

    // Récupération des champs du formulaire
    $prenom = $_POST['firstName'] ?? '';
    $nom = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $adresse = $_POST['address'] ?? '';
    $ville = $_POST['city'] ?? '';
    $codePostal = $_POST['zipCode'] ?? '';
    $grade = 'utilisateur';

    // Validation de base
    if ($prenom && $nom && $email && $password) {
        try {
            $sql = "INSERT INTO users 
                (user_firstname, user_name, user_mail, user_password, user_address, user_city, user_zipcode, user_grade)
                VALUES 
                (:prenom, :nom, :email, :password, :adresse, :ville, :codePostal, :grade)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password); // À hasher en production !
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':codePostal', $codePostal);
            $stmt->bindParam(':grade', $grade);

            $stmt->execute();

            // Redirection vers page de succès (ou retour au formulaire avec ?success)
            echo "<script>
                localStorage.setItem('registerSuccess', '✅ Enregistrement réussi !');
                window.location.href = 'connexion.html';
            </script>";
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
