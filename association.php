<?php
include_once './DBConnect/db_connect.php';

// Récupération du paramètre URL
$assoName = isset($_GET['asso']) ? $_GET['asso'] : '';

// Requête SQL préparée pour sécurité
$stmt = $pdo->prepare("SELECT * FROM associations WHERE nom = :nom OR slug = :nom");
$stmt->execute([':nom' => $assoName]);
$association = $stmt->fetch(PDO::FETCH_ASSOC);

// Si association non trouvée
if (!$association) {
    header("HTTP/1.0 404 Not Found");
    $pageTitle = "Association non trouvée";
} else {
    $pageTitle = $association['nom'] . " - Détails";
}

// Récupération des handicaps liés (si table de relation)
$handicaps = [];
if ($association) {
    $stmt = $pdo->prepare("
        SELECT h.nom 
        FROM handicaps h
        JOIN association_handicap ah ON h.id = ah.handicap_id
        WHERE ah.association_id = :id
    ");
    $stmt->execute([':id' => $association['id']]);
    $handicaps = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="css/association.css">
</head>
<body>
<a href="javascript:history.back()" class="back-button">← Retour aux associations</a>

<div class="association-container">
    <?php if ($association): ?>
        <div class="association-header">
            <img src="<?= htmlspecialchars($association['logo_url']) ?>"
                 alt="Logo <?= htmlspecialchars($association['nom']) ?>"
                 class="association-logo"
                 onerror="this.src='images/default-asso.jpg'">
            <div class="association-info">
                <h1><?= htmlspecialchars($association['nom']) ?></h1>
                <p class="description"><?= nl2br(htmlspecialchars($association['description'])) ?></p>
            </div>
        </div>

        <div class="association-details">
            <section>
                <h2>Informations de contact</h2>
                <ul class="contact-list">
                    <?php if ($association['website']): ?>
                        <li>Site web: <a href="<?= htmlspecialchars($association['website']) ?>" target="_blank">Visiter le site</a></li>
                    <?php endif; ?>
                    <?php if ($association['telephone']): ?>
                        <li>Téléphone: <?= htmlspecialchars($association['telephone']) ?></li>
                    <?php endif; ?>
                    <?php if ($association['email']): ?>
                        <li>Email: <a href="mailto:<?= htmlspecialchars($association['email']) ?>"><?= htmlspecialchars($association['email']) ?></a></li>
                    <?php endif; ?>
                    <?php if ($association['adresse']): ?>
                        <li>Adresse: <?= nl2br(htmlspecialchars($association['adresse'])) ?></li>
                    <?php endif; ?>
                </ul>
            </section>

            <?php if (!empty($handicaps)): ?>
                <section>
                    <h2>Handicaps concernés</h2>
                    <ul class="handicaps-list">
                        <?php foreach ($handicaps as $handicap): ?>
                            <li><?= htmlspecialchars($handicap) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>

            <?php if ($association['contenu']): ?>
                <section class="additional-content">
                    <?= $association['contenu'] ?>
                </section>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="not-found">
            <h1>Association non trouvée</h1>
            <p>Désolé, l'association "<?= htmlspecialchars($assoName) ?>" n'existe pas dans notre annuaire.</p>
            <a href="index.php" class="button">Retour à l'accueil</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>