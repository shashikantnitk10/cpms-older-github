<?php
/**
 * Task Class - AI-Powered Task Management
 */

require_once __DIR__ . '/../config/Database.php';

class Task {
    private $db;
    private $table = 'cpms_task';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Get all tasks for a project
     */
    public function getTasksByProject($project_id) {
        $query = "SELECT t.*, u.user_name as owner_name, a.activity_name 
                  FROM " . $this->table . " t
                  LEFT JOIN cpms_user u ON t.task_owner = u.user_trgm
                  LEFT JOIN cpms_activity a ON t.task_activity_cd = a.acivity_cd
                  WHERE t.task_project_id = ?
                  ORDER BY t.task_pln_start_dt";
        
        try {
            return $this->db->getRows($query, [$project_id], 's');
        } catch (Exception $e) {
            error_log("Get tasks error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get task by ID
     */
    public function getTaskById($task_id) {
        $query = "SELECT t.*, u.user_name as owner_name, a.activity_name 
                  FROM " . $this->table . " t
                  LEFT JOIN cpms_user u ON t.task_owner = u.user_trgm
                  LEFT JOIN cpms_activity a ON t.task_activity_cd = a.acivity_cd
                  WHERE t.task_id = ?";
        
        try {
            return $this->db->getRow($query, [$task_id], 'i');
        } catch (Exception $e) {
            error_log("Get task error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Complete task and record actual effort
     */
    public function completeTask($task_id, $actual_budget = 0) {
        $query = "UPDATE " . $this->table . " 
                  SET task_act_end_dt = NOW(), task_act_budget = ?
                  WHERE task_id = ?";
        
        try {
            $this->db->executeQuery($query, [$actual_budget, $task_id], 'ii');
            return true;
        } catch (Exception $e) {
            error_log("Complete task error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * AI-POWERED: Detect overdue tasks and alert
     */
    public function getOverdueTasks() {
        $query = "SELECT t.*, p.project_cd, u.user_name, 
                         DATEDIFF(NOW(), t.task_pln_end_dt) as days_overdue
                  FROM " . $this->table . " t
                  JOIN cpms_project p ON t.task_project_id = p.project_cd
                  LEFT JOIN cpms_user u ON t.task_owner = u.user_trgm
                  WHERE t.task_pln_end_dt < NOW() AND t.task_act_end_dt IS NULL
                  ORDER BY t.task_pln_end_dt";
        
        try {
            return $this->db->getRows($query);
        } catch (Exception $e) {
            error_log("Get overdue tasks error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get tasks by owner (for dashboard)
     */
    public function getTasksByOwner($owner_trgm) {
        $query = "SELECT t.*, p.project_cd, a.activity_name, 
                         CASE 
                           WHEN task_act_end_dt IS NOT NULL THEN 'Completed'
                           WHEN task_pln_end_dt < NOW() THEN 'Overdue'
                           WHEN DATEDIFF(task_pln_end_dt, NOW()) <= 3 THEN 'Due Soon'
                           ELSE 'In Progress'
                         END as task_status
                  FROM " . $this->table . " t
                  JOIN cpms_project p ON t.task_project_id = p.project_cd
                  LEFT JOIN cpms_activity a ON t.task_activity_cd = a.acivity_cd
                  WHERE t.task_owner = ?
                  ORDER BY t.task_pln_end_dt";
        
        try {
            return $this->db->getRows($query, [$owner_trgm], 's');
        } catch (Exception $e) {
            error_log("Get tasks by owner error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * AI-POWERED: Get task effort metrics
     */
    public function getEffortMetrics($project_cd) {
        $query = "SELECT 
                    AVG(DATEDIFF(task_act_end_dt, task_act_start_dt)) as avg_completion_days,
                    AVG(task_act_budget) as avg_effort,
                    MAX(task_act_budget) as max_effort,
                    MIN(task_act_budget) as min_effort
                  FROM " . $this->table . "
                  WHERE task_project_id = ? AND task_act_end_dt IS NOT NULL";
        
        try {
            return $this->db->getRow($query, [$project_cd], 's');
        } catch (Exception $e) {
            error_log("Get effort metrics error: " . $e->getMessage());
            return null;
        }
    }
}
?>
