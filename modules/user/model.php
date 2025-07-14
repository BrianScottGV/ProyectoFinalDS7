<?php

require_once __DIR__ . '/../core/database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getUserById($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUserProfile($user_id, $username, $email) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $email, $user_id);
        return $stmt->execute();
    }

    public function updateUserPreferences($user_id, $genres) {
        // First, delete existing preferences for the user
        $stmt = $this->db->prepare("DELETE FROM user_preferences WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Then, insert new preferences
        $success = true;
        foreach ($genres as $genre_id) {
            $stmt = $this->db->prepare("INSERT INTO user_preferences (user_id, genre_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user_id, $genre_id);
            if (!$stmt->execute()) {
                $success = false;
                break;
            }
        }
        return $success;
    }

    public function getUserPreferences($user_id) {
        $stmt = $this->db->prepare("SELECT genre_id FROM user_preferences WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $preferences = [];
        while ($row = $result->fetch_assoc()) {
            $preferences[] = $row['genre_id'];
        }
        return $preferences;
    }

    public function getAllGenres() {
        $stmt = $this->db->prepare("SELECT id, name FROM genres");
        $stmt->execute();
        $result = $stmt->get_result();
        $genres = [];
        while ($row = $result->fetch_assoc()) {
            $genres[] = $row;
        }
        return $genres;
    }
}

?>