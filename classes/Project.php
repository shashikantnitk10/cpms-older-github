<?php
/**
 * Project Class - AI-Powered Project Management
 */

require_once __DIR__ . '/../config/Database.php';

class Project {
    private $db;
    private $table = 'cpms_project';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Get all projects with owner details
     */
    public function getAllProjects() {
        $query = "SELECT p.*, u.user_name as owner_name, r.user_name as reviewer_name 
                  FROM " . $this->table . " p
                  LEFT JOIN cpms_user u ON p.project_owner = u.user_trgm
                  LEFT JOIN cpms_user r ON p.project_reviewer = r.user_trgm
                  ORDER BY p.project_cd DESC";
        
        try {
            return $this->db->getRows($query);
        } catch (Exception $e) {
            error_log("Get projects error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get project by code
     */
    public function getProjectByCode($project_cd) {
        $query = "SELECT p.*, u.user_name as owner_name, r.user_name as reviewer_name 
                  FROM " . $this->table . " p
                  LEFT JOIN cpms_user u ON p.project_owner = u.user_trgm
                  LEFT JOIN cpms_user r ON p.project_reviewer = r.user_trgm
                  WHERE p.project_cd = ?";
        
        try {
            return $this->db->getRow($query, [$project_cd], 's');
        } catch (Exception $e) {
            error_log("Get project error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * AI-POWERED: Get project progress analytics
     */
    public function getProjectProgress($project_cd) {
        $query = "SELECT 
                    COUNT(*) as total_tasks,
                    SUM(CASE WHEN task_act_end_dt IS NOT NULL THEN 1 ELSE 0 END) as completed_tasks,
                    SUM(task_pln_budget) as planned_budget,
                    SUM(task_act_budget) as actual_budget,
                    ROUND((SUM(CASE WHEN task_act_end_dt IS NOT NULL THEN 1 ELSE 0 END) / NULLIF(COUNT(*), 0) * 100), 2) as completion_percentage
                  FROM cpms_task 
                  WHERE task_project_id = ?";
        
        try {
            $result = $this->db->getRow($query, [$project_cd], 's');
            return $result ?: ['total_tasks' => 0, 'completed_tasks' => 0, 'completion_percentage' => 0];
        } catch (Exception $e) {
            error_log("Get project progress error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * AI-POWERED: Predict project deadline based on historical data
     */
    public function predictDeadline($project_cd) {
        $query = "SELECT COUNT(*) as pending_tasks, 
                         AVG(DATEDIFF(task_act_end_dt, task_pln_start_dt)) as avg_duration_days
                  FROM cpms_task 
                  WHERE task_project_id = ? AND task_act_end_dt IS NULL";
        
        try {
            $result = $this->db->getRow($query, [$project_cd], 's');
            
            if ($result && $result['pending_tasks'] > 0 && $result['avg_duration_days']) {
                $predicted_days = ceil($result['pending_tasks'] * $result['avg_duration_days']);
                $predicted_date = date('Y-m-d', strtotime("+$predicted_days days"));
                return $predicted_date;
            }
            
            return null;
        } catch (Exception $e) {
            error_log("Predict deadline error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get projects by owner
     */
    public function getProjectsByOwner($owner_trgm) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE project_owner = ? 
                  ORDER BY project_cd DESC";
        
        try {
            return $this->db->getRows($query, [$owner_trgm], 's');
        } catch (Exception $e) {
            error_log("Get projects by owner error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * AI-POWERED: Get budget variance and forecast
     */
    public function getBudgetAnalysis($project_cd) {
        $query = "SELECT 
                    project_budget_abacus as allocated_budget,
                    SUM(t.task_pln_budget) as planned_spend,
                    SUM(t.task_act_budget) as actual_spend,
                    ROUND(((SUM(t.task_act_budget) - project_budget_abacus) / project_budget_abacus * 100), 2) as variance_percentage
                  FROM " . $this->table . " p
                  LEFT JOIN cpms_task t ON p.project_cd = t.task_project_id
                  WHERE p.project_cd = ?
                  GROUP BY p.project_cd";
        
        try {
            return $this->db->getRow($query, [$project_cd], 's');
        } catch (Exception $e) {
            error_log("Get budget analysis error: " . $e->getMessage());
            return null;
        }
    }
}
?>