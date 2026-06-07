<?php
/**
 * Tasks API Endpoint
 * RESTful API for task operations
 */

require_once __DIR__ . '/../config/Security.php';
require_once __DIR__ . '/../classes/Task.php';

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
    $taskClass = new Task();
    
    if ($method === 'GET') {
        if ($action === 'overdue') {
            $tasks = $taskClass->getOverdueTasks();
            echo json_encode(['success' => true, 'data' => $tasks]);
        } elseif ($action === 'myTasks') {
            $tasks = $taskClass->getTasksByOwner($_SESSION['user_trgm']);
            echo json_encode(['success' => true, 'data' => $tasks]);
        } else {
            echo json_encode(['success' => true, 'data' => []]);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
    
} catch (Exception $e) {
    error_log("Tasks API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}
?>