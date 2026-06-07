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
    
    switch ($method) {
        case 'GET':
            if ($action === 'overdue') {
                // Get overdue tasks (AI-powered detection)
                $tasks = $taskClass->getOverdueTasks();
                echo json_encode(['success' => true, 'data' => $tasks]);
            }
            elseif ($action === 'myTasks') {
                // Get user's tasks
                $tasks = $taskClass->getTasksByOwner($_SESSION['user_trgm']);
                echo json_encode(['success' => true, 'data' => $tasks]);
            }
            elseif ($action === 'byProject' && isset($_GET['project_id'])) {
                // Get tasks by project
                $tasks = $taskClass->getTasksByProject(Security::sanitizeInput($_GET['project_id']));
                echo json_encode(['success' => true, 'data' => $tasks]);
            }
            elseif ($action === 'metrics' && isset($_GET['project_id'])) {
                // Get effort metrics (AI-powered)
                $metrics = $taskClass->getEffortMetrics(Security::sanitizeInput($_GET['project_id']));
                echo json_encode(['success' => true, 'data' => $metrics]);
            }
            elseif ($action === 'getById' && isset($_GET['task_id'])) {
                // Get task details
                $task = $taskClass->getTaskById(intval($_GET['task_id']));
                if ($task) {
                    echo json_encode(['success' => true, 'data' => $task]);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Task not found']);
                }
            }
            else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid action']);
            }
            break;
            
        case 'POST':
            // Verify CSRF token
            if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
                http_response_code(403);
                echo json_encode(['error' => 'CSRF token validation failed']);
                exit;
            }
            
            if ($action === 'complete' && isset($_POST['task_id'])) {
                // Complete task
                $actual_budget = isset($_POST['actual_budget']) ? floatval($_POST['actual_budget']) : 0;
                $success = $taskClass->completeTask(intval($_POST['task_id']), $actual_budget);
                
                if ($success) {
                    echo json_encode(['success' => true, 'message' => 'Task completed successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['error' => 'Failed to complete task']);
                }
            }
            else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid action']);
            }
            break;
            
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    }
    
} catch (Exception $e) {
    error_log("Tasks API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}
?>
