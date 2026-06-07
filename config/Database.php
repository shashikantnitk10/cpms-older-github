<?php
/**
 * Database Configuration Class
 * Handles all database connections with improved security
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'cpms_old';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->db_name
            );

            // Set charset to UTF8
            if (!$this->conn->set_charset("utf8mb4")) {
                throw new Exception("Error loading character set utf8mb4");
            }

            // Enable error reporting
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        } catch (Exception $e) {
            die("Database Connection Error: " . $e->getMessage());
        }

        return $this->conn;
    }

    /**
     * Execute a prepared statement query
     */
    public function executeQuery($query, $params = [], $types = '') {
        $conn = $this->connect();
        
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        return $stmt;
    }

    /**
     * Get single row result
     */
    public function getRow($query, $params = [], $types = '') {
        $stmt = $this->executeQuery($query, $params, $types);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Get all rows result
     */
    public function getRows($query, $params = [], $types = '') {
        $stmt = $this->executeQuery($query, $params, $types);
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Close database connection
     */
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>