<?php
// Assumes $user_data is available from the controller
if (!isset($user_data)) {
    echo "Error: User data not available.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="/public/css/style.css"> <!-- Assuming a public CSS file -->
</head>
<body>
    <?php include __DIR__ . '/../../templates/header.php'; ?>
    <?php include __DIR__ . '/../../templates/navbar.php'; ?>

    <div class="container">
        <h1>Perfil de Usuario</h1>

        <?php if (isset($message)): ?>
            <p style="color: green;"><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="action" value="update_profile">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>

            <button type="submit">Actualizar Perfil</button>
        </form>

        <h2>Tus Preferencias de Género</h2>
        <p>Gestiona tus preferencias <a href="?route=user&view=preferences">aquí</a>.</p>

        <h2>Tus Recomendaciones</h2>
        <p>Ver tus recomendaciones <a href="?route=recommendations">aquí</a>.</p>
    </div>

    <?php include __DIR__ . '/../../templates/footer.php'; ?>
</body>
</html>