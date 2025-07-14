<?php

require_once __DIR__ . '/../core/SessionManager.php';
require_once __DIR__ . '/../user/model.php'; // To get user preferences
require_once __DIR__ . '/model.php';

SessionManager::startSession();

if (!SessionManager::isLoggedIn()) {
    header('Location: /public/index.php?route=login');
    exit();
}

$user_id = SessionManager::getUserId();

$userModel = new UserModel();
$recommendationsModel = new RecommendationsModel();

$user_preferences = $userModel->getUserPreferences($user_id);

// Get recommendations based on user preferences
$recommended_content = $recommendationsModel->getRecommendationsByGenres($user_preferences);

// If no genre preferences, get some general recommendations (e.g., most popular)
if (empty($recommended_content)) {
    $recommended_content = $recommendationsModel->getPopularContent(); // You'll need to implement this in the model
}

include __DIR__ . '/view_recommendations.php';

?>