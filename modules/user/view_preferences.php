<?php
// Assumes $user_preferences and $all_genres are available from the controller
if (!isset($user_preferences) || !isset($userModel)) {
    echo "Error: Preferences data not available.";
    exit();
}

$all_genres = $userModel->getAllGenres();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias de Género</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../../templates/header.php'; ?>
    <?php include __DIR__ . '/../../templates/navbar.php'; ?>

    <div class="container">
        <h1>Tus Preferencias de Género</h1>

        <?php if (isset($message)): ?>
            <p style="color: green;"><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="action" value="update_preferences">
            <p>Selecciona tus géneros favoritos:</p>
            <?php foreach ($all_genres as $genre): ?>
                <input type="checkbox" id="genre_<?php echo $genre['id']; ?>" name="genres[]" value="<?php echo $genre['id']; ?>"
                    <?php echo in_array($genre['id'], $user_preferences) ? 'checked' : ''; ?>>
                <label for="genre_<?php echo $genre['id']; ?>"><?php echo htmlspecialchars($genre['name']); ?></label><br>
            <?php endforeach; ?>
            <br>
            <button type="submit">Guardar Preferencias</button>
        </form>

        <p><a href="?route=user&view=profile">Volver al Perfil</a></p>
    </div>

    <?php include __DIR__ . '/../../templates/footer.php'; ?>
</body>
</html>