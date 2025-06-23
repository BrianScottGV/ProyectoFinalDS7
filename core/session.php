<?php
require_once 'Config.php';

class SessionManager {
    private const TIMEOUT = 1800;

    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.use_only_cookies', 1);
            ini_set('session.cookie_httponly', 1);
            session_start();
        }

        if (isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] > self::TIMEOUT) {
            session_unset();
            session_destroy();
            header('Location: ' . Config::BASE_URL . 'modules/auth/view_login.php?timeout=1');
            exit;
        }
        $_SESSION['LAST_ACTIVITY'] = time();

        if (!isset($_SESSION['CREATED'])) {
            $_SESSION['CREATED'] = time();
        } elseif (time() - $_SESSION['CREATED'] > 300) {
            session_regenerate_id(true);
            $_SESSION['CREATED'] = time();
        }
    }
}