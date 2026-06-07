<?php
/**
 * User Class - Secure Authentication & Management
 */

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../config/Security.php';

class User {
    private $db;
    private $table = 'cpms_user';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Authenticate user with secure password verification
     */
    public function authenticate($user_trgm, $password) {
        $user_trgm = Security::sanitizeInput($user_trgm);
        
        $query = "SELECT user_trgm, user_name, user_password, user_access_typ, user_role, user_status FROM " . $this->table . " WHERE user_trgm = ? AND user_status = 'A'";
        
        try {
            $user = $this->db->getRow($query, [$user_trgm], 's');
            
            if ($user) {
                // For now, support both hashed and plain passwords for backward compatibility
                $password_match = false;
                
                // Try bcrypt verification first
                if (password_verify($password, $user['user_password'])) {
                    $password_match = true;
                }
                // Fall back to plain text comparison (existing passwords)
                elseif ($password === $user['user_password']) {
                    $password_match = true;
                }
                
                if ($password_match) {
                    $this->updateLastLogin($user_trgm);
                    return $user;
                }
            }
            
            return false;
        } catch (Exception $e) {
            error_log("Authentication error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all active users
     */
    public function getAllActiveUsers() {
        $query = "SELECT user_trgm, user_name, user_role FROM " . $this->table . " WHERE user_status = 'A' ORDER BY user_name";
        
        try {
            return $this->db->getRows($query);
        } catch (Exception $e) {
            error_log("Get users error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get user by TRGM
     */
    public function getUserByTrgm($user_trgm) {
        $user_trgm = Security::sanitizeInput($user_trgm);
        $query = "SELECT * FROM " . $this->table . " WHERE user_trgm = ?";
        
        try {
            return $this->db->getRow($query, [$user_trgm], 's');
        } catch (Exception $e) {
            error_log("Get user error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Change user password securely
     */
    public function changePassword($user_trgm, $new_password) {
        $query = "UPDATE " . $this->table . " SET user_password = ? WHERE user_trgm = ?";
        
        try {
            $hashed_password = Security::hashPassword($new_password);
            $this->db->executeQuery($query, [$hashed_password, $user_trgm], 'ss');
            return true;
        } catch (Exception $e) {
            error_log("Change password error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update last login timestamp
     */
    private function updateLastLogin($user_trgm) {
        $query = "UPDATE " . $this->table . " SET user_last_login = NOW() WHERE user_trgm = ?";
        try {
            $this->db->executeQuery($query, [$user_trgm], 's');
        } catch (Exception $e) {
            error_log("Update last login error: " . $e->getMessage());
        }
    }
}
?>