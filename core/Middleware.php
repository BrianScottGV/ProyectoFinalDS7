<?php
require_once 'SessionManager.php';

class Middleware {
    public static function requireAuth(): void {
        SessionManager::start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . Config::BASE_URL . "modules/auth/view_login.php");
            exit;
        }
    }

    public static function requireAdmin(): void {
        SessionManager::start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header("Location: " . Config::BASE_URL . "index.php");
            exit;
        }
    }
}