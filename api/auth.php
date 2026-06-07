<?php
/**
 * Authentication API Endpoint
 * Handles user login with enhanced security
 */

require_once __DIR__ . '/../config/Security.php';
require_once __DIR__ . '/../classes/User.php';

// Start secure session
Security::startSecureSession();

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get and sanitize input
$user_trgm = isset($_POST['uname']) ? Security::sanitizeInput($_POST['uname']) : '';
$password = isset($_POST['psw']) ? $_POST['psw'] : '';

// Check required fields
if (empty($user_trgm) || empty($password)) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and password required']);
    exit;
}

try {
    // Authenticate user
    $userClass = new User();
    $user = $userClass->authenticate($user_trgm, $password);
    
    if ($user) {
        // Set session
        $_SESSION['user_trgm'] = $user['user_trgm'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_role'] = $user['user_role'];
        $_SESSION['user_access_typ'] = $user['user_access_typ'];
        $_SESSION['login_time'] = time();
        
        // Log successful login
        error_log("User " . $user_trgm . " logged in successfully at " . date('Y-m-d H:i:s'));
        
        // Return success with redirect
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'user' => $user['user_name']
        ]);
    } else {
        // Log failed attempt
        error_log("Failed login attempt for user: " . $user_trgm . " at " . date('Y-m-d H:i:s'));
        
        http_response_code(401);
        echo json_encode(['error' => 'Invalid username or password']);
    }
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'An error occurred during login']);
}
?>