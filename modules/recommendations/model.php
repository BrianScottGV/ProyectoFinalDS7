<?php

require_once __DIR__ . '/../core/database.php';

class RecommendationsModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getRecommendationsByGenres($genre_ids) {
        if (empty($genre_ids)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($genre_ids), '?'));
        $types = str_repeat('i', count($genre_ids));

        $query = "SELECT DISTINCT c.* FROM content c
                  JOIN content_genres cg ON c.id = cg.content_id
                  WHERE cg.genre_id IN ($placeholders)
                  ORDER BY c.release_date DESC LIMIT 10"; // Example: order by release date

        $stmt = $this->db->prepare($query);
        $stmt->bind_param($types, ...$genre_ids);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPopularContent() {
        // Example: Fetch 10 most recently added content if no preferences are set
        $query = "SELECT * FROM content ORDER BY release_date DESC LIMIT 10";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // You might add more recommendation logic here, e.g., based on user history, ratings, etc.
}

?>