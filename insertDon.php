<?php
session_start();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once './DBConnect/db_connect.php';

    $montant = $_POST['montant_don'] ?? '';
    $recurence = $_POST['recurrence'] ?? '';
    $id_user = $_POST['id_user'] ?? null;
    $id_assos = $_POST['id_assos'] ?? '';

    if (!$montant) {
        $message = "⚠️ Merci de saisir un montant.";
    }

    
    if (empty($message)) {
        try {

            $sql = "INSERT INTO don 
            (montant_don, reccurence, id_user, id_assos)
            VALUES (:montant_don, :recurrence, :id_user, :id_assos)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':montant_don', $montant_don);
            $stmt->bindParam(':recurrence', $recurrence);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_assos', $id_assos);
            $stmt->execute();

            header("Location: donation.php");
            exit;
        } catch (PDOException $e) {
            $message = "❌ Erreur lors de l'enregistrement de don : " . $e->getMessage();
        }
    }

    // En cas d'erreur
    echo "<script>
        sessionStorage.setItem('DonationError', '" . addslashes($message) . "');
        window.location.href = 'donation.php';
    </script>";
    exit;
}
?>
