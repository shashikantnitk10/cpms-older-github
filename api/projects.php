<?php
/**
 * Projects API Endpoint
 * RESTful API for project operations
 */

require_once __DIR__ . '/../config/Security.php';
require_once __DIR__ . '/../classes/Project.php';

Security::startSecureSession();

// Check authentication
if (!isset($_SESSION['user_trgm'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? Security::sanitizeInput($_GET['action']) : '';

try {
    $projectClass = new Project();
    
    if ($method === 'GET') {
        if ($action === 'all') {
            $projects = $projectClass->getAllProjects();
            echo json_encode(['success' => true, 'data' => $projects]);
        } elseif ($action === 'progress' && isset($_GET['code'])) {
            $progress = $projectClass->getProjectProgress(Security::sanitizeInput($_GET['code']));
            echo json_encode(['success' => true, 'data' => $progress]);
        } else {
            $projects = $projectClass->getProjectsByOwner($_SESSION['user_trgm']);
            echo json_encode(['success' => true, 'data' => $projects]);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
    
} catch (Exception $e) {
    error_log("Projects API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}
?>