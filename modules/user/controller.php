<?php

require_once __DIR__ . '/../core/SessionManager.php';
require_once __DIR__ . '/../core/Security.php';
require_once __DIR__ . '/model.php';

SessionManager::startSession();

$userModel = new UserModel();

if (!SessionManager::isLoggedIn()) {
    header('Location: /public/index.php?route=login');
    exit();
}

$user_id = SessionManager::getUserId();

// Handle profile updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_profile') {
    $username = Security::sanitizeInput($_POST['username']);
    $email = Security::sanitizeInput($_POST['email']);

    if ($userModel->updateUserProfile($user_id, $username, $email)) {
        $message = "Perfil actualizado exitosamente.";
    } else {
        $error = "Error al actualizar el perfil.";
    }
}

// Handle genre preferences updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_preferences') {
    $genres = isset($_POST['genres']) ? $_POST['genres'] : [];
    if ($userModel->updateUserPreferences($user_id, $genres)) {
        $message = "Preferencias actualizadas exitosamente.";
    } else {
        $error = "Error al actualizar las preferencias.";
    }
}

$user_data = $userModel->getUserById($user_id);
$user_preferences = $userModel->getUserPreferences($user_id);

// Load views based on route or action
if (isset($_GET['view'])) {
    switch ($_GET['view']) {
        case 'profile':
            include __DIR__ . '/view_profile.php';
            break;
        case 'preferences':
            include __DIR__ . '/view_preferences.php';
            break;
        default:
            include __DIR__ . '/view_profile.php';
            break;
    }
} else {
    include __DIR__ . '/view_profile.php';
}

?>