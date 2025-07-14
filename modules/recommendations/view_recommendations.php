<?php
// Assumes $recommended_content is available from the controller
if (!isset($recommended_content)) {
    echo "Error: Recommended content not available.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus Recomendaciones</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../../templates/header.php'; ?>
    <?php include __DIR__ . '/../../templates/navbar.php'; ?>

    <div class="container">
        <h1>Tus Recomendaciones</h1>

        <?php if (empty($recommended_content)): ?>
            <p>No hay recomendaciones disponibles en este momento. Por favor, actualiza tus preferencias de género.</p>
        <?php else: ?>
            <div class="recommendations-list">
                <?php foreach ($recommended_content as $content): ?>
                    <div class="content-item">
                        <h3><?php echo htmlspecialchars($content['title']); ?></h3>
                        <p><?php echo htmlspecialchars($content['description']); ?></p>
                        <!-- Add more content details as needed, e.g., image, link to detail page -->
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <p><a href="?route=user&view=preferences">Gestionar Preferencias</a></p>
    </div>

    <?php include __DIR__ . '/../../templates/footer.php'; ?>
</body>
</html>